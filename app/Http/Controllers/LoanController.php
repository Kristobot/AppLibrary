<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Http\Resources\LoanResource;
use App\Models\Copy;
use App\Models\Loan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoanController extends Controller
{

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

        return LoanResource::collection($loans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        //
        $user = Auth()->user();
        $loan = Loan::create([
            'user_id' => $user->id
        ]);
        
        foreach ($request->copies as $id) {
            $copy = Copy::find($id);
            $copy->update([
                'copy_status_id' => 2
            ]);
        }

        $loan->copies()->attach($request->copies);

        $loan->refresh();

        $loan->with(['copies' => function($query){
            $query->with('book');
        }]);

        return new LoanResource($loan);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
        $loan->with(['copies' => function($query){
            $query->with('book');
        }]);

        return new LoanResource($loan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        //
        $loan->update($request->validated());
        return new LoanResource($loan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
        foreach ($loan->copies as $copy) {
            $copy->update([
                'copy_status_id' => 1
            ]);
        }
        $loan->delete();
        return response()->json(['Success' => 'Recurso Eliminado'], Response::HTTP_OK);
    }
}
