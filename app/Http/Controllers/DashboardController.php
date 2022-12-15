<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\HojaMonitoreo;
use App\Models\User;
use App\Models\Insumo;
use App\Models\Problema;
use App\Models\Minuta;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
       $count_users = User::count();
       $count_problemas = Problema::where('solucionado', 0)->count();
       $count_problemas_table = Problema::where('solucionado', 0)->where('fecha_aplicacion', '>=', now())->take(8)->get();
       $count_problemas_solucionados = Problema::where('solucionado', 1)->count();
       $count_insumos = Insumo::count();
       $count_problemas_month = Problema::whereYear('fecha_solucionado', now()->year)
                              ->select(DB::raw("MONTH(fecha_solucionado) month"),DB::raw("count('month') as problemas_solucionados"))
                              ->groupby('month')->get();

// Visitor::whereYear('created_at', Carbon::now()->year)
// ->select(DB::raw("MONTH(created_at) month"),DB::raw("count('month') as vistors_count"))
//        ->groupby('month')
//        ->get();

       return Inertia::render('Dashboard', [
           'count_users' => $count_users,
           'count_problemas' => $count_problemas,
           'count_problemas_table' => $count_problemas_table,
           'count_insumos' => $count_insumos,
           'count_problemas_solucionados' => $count_problemas_solucionados,
           'count_problemas_month' => $count_problemas_month,
       ]);
    }
}
