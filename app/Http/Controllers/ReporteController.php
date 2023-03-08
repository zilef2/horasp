<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Http\Requests\StoreReporteRequest;
use App\Http\Requests\UpdateReporteRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reports = Reporte::query();
        if ($request->has('search')) {
            // $reports->whereBetween('hora_inicio',  [$request->search,'2100-01-01']);
            $reports->orWhere('observaciones', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $reports->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        $nombresTabla =[
            ["#","Hora inicio","Hora Fin","centro compra","Observaciones"],
            ["#","hora_inicio","hora_fin","centro_compra_id","observaciones"]
        ];

        return Inertia::render('Reportes/Index', [
            'title'       => __('app.label.Report'),
            'filters'     => $request->all(['search', 'field', 'order']),
            'perPage'     => (int) $perPage,
            'reports'     => $reports->paginate($perPage),
            'breadcrumbs' => [['label' => __('app.label.reporte'), 'href' => route('reportes.index')]],
            'nombresTabla'=> $nombresTabla,
        ]);
        // return Reporte::all();
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
     * @param  \App\Http\Requests\StoreReporteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReporteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReporteRequest  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReporteRequest $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
