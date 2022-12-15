<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMinutaRequest;
use App\Http\Requests\UpdateMinutaRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Minuta;
use App\Models\Problema;
use Inertia\Inertia;

class MinutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minutas = Minuta::latest()->get();

        return Inertia::render('Minuta/index', compact('minutas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Minuta/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMinutaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMinutaRequest $request)
    {
        $minuta = Minuta::create( $request->all() );


        return redirect()->route('minuta.show', ['minutum' => $minuta->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Minuta  $minuta
     * @return \Illuminate\Http\Response
     */
    public function show(Minuta $minutum)
    {
         $show_minuta = Minuta::where('id', $minutum->id)->with('user', 'actualizado')->get();
         $problemas = Problema::where('minuta_id', $minutum->id)->with('user')->latest()->get();
         return Inertia::render('Minuta/show', [
             'minutum' => $show_minuta[0],
             'problemas' => $problemas,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Minuta  $minuta
     * @return \Illuminate\Http\Response
     */
    public function edit(Minuta $minutum)
    {
        return Inertia::render('Minuta/edit', compact('minutum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMinutaRequest  $request
     * @param  \App\Models\Minuta  $minuta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMinutaRequest $request, Minuta $minutum)
    {
        $minutum->update( $request->all() );

        return redirect()->route('minuta.show', compact('minutum'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Minuta  $minuta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Minuta $minuta)
    {
        //
    }

    public function print_pdf(Minuta $minutum)
    {
        $pdf = Pdf::loadView('minuta', compact('minutum'));
        return $pdf->download('minuta_' . $minutum->id . '_' . $minutum->fecha_analisis . '.pdf');
    }
}
