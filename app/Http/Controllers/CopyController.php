<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCopyRequest;
use App\Http\Resources\CopyResource;
use App\Models\Copy;
use Illuminate\Http\Request;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $copie = Copy::with(['book'])->get();
        return CopyResource::collection($copie);
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
    public function store(StoreCopyRequest $request)
    {
        //
        $copie = Copy::create($request->all());
        $copie->with('book');
        return new CopyResource($copie);
    }

    /**
     * Display the specified resource.
     */
    public function show(Copy $copie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Copy $copie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Copy $copie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copy $copie)
    {
        //
    }
}
