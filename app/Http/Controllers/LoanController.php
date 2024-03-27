<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Models\Copy;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $showPastLoans = $request->query('showPastLoans');
        $loanQuery = Loan::query();
        if ($showPastLoans) {
            return $loanQuery->onlyTrashed()->get();
        }

        return $loanQuery->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        //
        //dd($request->copies);

        $loan = Loan::create($request->all());

        foreach ($request->copies as $id) {
            $copy = Copy::find($id);
            $copy->update(['copy_status_id' => 2]);
            //dd($copy);
        }

        $loan->copies()->attach($request->copies);

    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
        $loan->delete();
        //dd($loan->copies);
        foreach ($loan->copies as $copie) {
            $copie->update(['copy_status_id' => 1]);
            $loan->copies()->detach($copie->id);
        }
    }
}
