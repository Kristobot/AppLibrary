<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Http\Resources\LoanCollection;
use App\Http\Resources\LoanResource;
use App\Models\Copy;
use App\Models\Loan;
use App\Services\LoanService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{

    public function __construct(
        public LoanService $loanService
    )
    {
        $this->authorizeResource(Loan::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $loans = Loan::when($request->showPastLoans, function($query){
            $query->onlyTrashed();
        })->with(['copies' => function($query){
            $query->with('book');
        }])->get();

        return new LoanCollection($loans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        //
        $loan = $this->loanService->create($request,$request->copies);

        $loan->load(['copies.book'])->get();

        return new LoanResource($loan);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
        $loan->load(['copies.book'])->get();
    
        return new LoanResource($loan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        //
        $loan->copies()->sync($request->copies);
        $loan->load('copies.books');
        return new LoanResource($loan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
        $this->loanService->returnCopies($loan);
        $loan->delete();
        return response()->json(['Success' => 'Recurso Eliminado'], Response::HTTP_OK);
    }
}
