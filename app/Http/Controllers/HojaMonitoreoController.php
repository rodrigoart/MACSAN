<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHojaMonitoreoRequest;
use App\Http\Requests\UpdateHojaMonitoreoRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\HojaMonitoreo;
use App\Models\User;
use App\Models\Insumo;
use Inertia\Inertia;

class HojaMonitoreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hojas_monitoreo = HojaMonitoreo::latest()->with(['insumos', 'user', 'actualizado', 'approved'])->get();

        return Inertia::render('HojasMonitoreo/index', compact('hojas_monitoreo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return Inertia::render('HojasMonitoreo/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHojaMonitoreoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHojaMonitoreoRequest $request)
    {
        $hoja = HojaMonitoreo::create($request->all());

        session()->flash('flash.banner', 'Nueva hoja de monitoreo creada');
        return redirect()->route('hoja-monitoreo.show', ['hoja_monitoreo' => $hoja->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HojaMonitoreo  $hojaMonitoreo
     * @return \Illuminate\Http\Response
     */
    public function show(HojaMonitoreo $hojaMonitoreo)
    {
         $hoja = HojaMonitoreo::where('id', $hojaMonitoreo->id)->with(['user', 'actualizado', 'approved', 'insumos_actualizado'])->get();
         $insumos = Insumo::where('hoja_monitoreo_id', $hojaMonitoreo->id)->with('user')->latest()->get();
         return Inertia::render('HojasMonitoreo/show', [
             'hoja' => $hoja[0],
             'insumos' => $insumos,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HojaMonitoreo  $hojaMonitoreo
     * @return \Illuminate\Http\Response
     */
    public function edit(HojaMonitoreo $hojaMonitoreo)
    {
        return Inertia::render('HojasMonitoreo/edit', ['hoja' => $hojaMonitoreo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHojaMonitoreoRequest  $request
     * @param  \App\Models\HojaMonitoreo  $hojaMonitoreo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHojaMonitoreoRequest $request, HojaMonitoreo $hojaMonitoreo)
    {
        // dd($request->file('img'));
        // $photo_link = $hojaMonitoreo->photo;
        $hojaMonitoreo->update($request->all());

        if($request->file('photo')){

            // Storage::disk('public')->delete($photo_link);
            $hojaMonitoreo->photo = $request->file('photo')->store('hojamonitoreo','public');
            $hojaMonitoreo->save();
        }

        session()->flash('flash.banner', 'Hoja de monitoreo actualizada');
        // return redirect()->route('hoja-monitoreo.index');
        return redirect()->route('hoja-monitoreo.show', ['hoja_monitoreo' => $request->hoja_monitoreo_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HojaMonitoreo  $hojaMonitoreo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HojaMonitoreo $hojaMonitoreo)
    {
        //
    }

    public function print_pdf(HojaMonitoreo $hojaMonitoreo)
    {
        $pdf = Pdf::loadView('hojamonitoreo', compact('hojaMonitoreo'));
        return $pdf->download('hojamonitoreo_' . $hojaMonitoreo->id . '_' . $hojaMonitoreo->fecha . '.pdf');
    }
}
