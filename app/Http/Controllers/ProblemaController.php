<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProblemaRequest;
use App\Http\Requests\UpdateProblemaRequest;
use App\Models\Problema;

class ProblemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProblemaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProblemaRequest $request)
    {
        Problema::create( $request->all() );

        return redirect()->route('minuta.show', ['minutum' => $request->minuta_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function show(Problema $problema)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function edit(Problema $problema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProblemaRequest  $request
     * @param  \App\Models\Problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProblemaRequest $request, Problema $problema)
    {
        $problema->update( $request->all() );

        return redirect()->route('minuta.show', ['minutum' => $request->minuta_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problema $problema)
    {
        $minutum = $problema->minuta_id;
        $problema->delete();

        return redirect()->route('minuta.show', ['minutum' => $minutum]);
    }
}
