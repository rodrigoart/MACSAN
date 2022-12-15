<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInsumoRequest;
use App\Http\Requests\UpdateInsumoRequest;
use Inertia\Inertia;
use App\Models\HojaMonitoreo;
use App\Models\Insumo;
use App\Models\User;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('hoja-monitoreo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hoja)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInsumoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsumoRequest $request)
    {
       Insumo::create($request->all());

        session()->flash('flash.banner', 'Nuevo insumo agregado');
        return redirect()->route('hoja-monitoreo.show', ['hoja_monitoreo' => $request->hoja_monitoreo_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit(Insumo $insumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInsumoRequest  $request
     * @param  \App\Models\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInsumoRequest $request, Insumo $insumo)
    {
        // dd($request);
        $insumo->update($request->all());

        session()->flash('flash.banner', 'Insumo actualizado');
        return redirect()->route('hoja-monitoreo.show', ['hoja_monitoreo' => $request->hoja_monitoreo_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insumo $insumo)
    {
        $hoja = $insumo->hoja_monitoreo_id;
        $insumo->delete();

        return redirect()->route('hoja-monitoreo.show', ['hoja_monitoreo' => $hoja]);
    }
}
