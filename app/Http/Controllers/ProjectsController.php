<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Projects = Project::query();
        if ($request->has('search')) {
            $Projects->orWhere('nombre', 'LIKE', "%" . $request->search . "%");
        }
        if ($request->has(['field', 'order'])) {
            $Projects->orderBy($request->field, $request->order);
        }
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        $nombresTabla =[
            ["nombre"],
            ["cliente"],
            ["num_modulos"],
            ["valor_tentativo"],
            ["valor_acordado"],
            ["valor_primer_pago"],
            ["fecha_primera_reunion"],
            ["fecha_primer_pago"],
            ["fecha_entrega"],
            ["observaciones"],
        ];

        return Inertia::render('Projects/Index', [
            'title'       => __('app.label.Project'),
            'filters'     => $request->all(['search', 'field', 'order']),
            'perPage'     => (int) $perPage,
            'Projects'     => $Projects->paginate($perPage),
            'breadcrumbs' => [['label' => __('app.label.Projects'), 'href' => route('Project.index')]],
            'nombresTabla'=> $nombresTabla,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project;
		$project->nombre = $request->input('nombre');
		$project->cliente = $request->input('cliente');
		$project->num_modulos = $request->input('num_modulos');
		$project->valor_tentativo = $request->input('valor_tentativo');
		$project->valor_acordado = $request->input('valor_acordado');
		$project->valor_primer_pago = $request->input('valor_primer_pago');
		$project->fecha_primera_reunion = $request->input('fecha_primera_reunion');
		$project->fecha_primer_pago = $request->input('fecha_primer_pago');
		$project->fecha_entrega = $request->input('fecha_entrega');
		$project->observaciones = $request->input('observaciones');
        $project->save();

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return Inertia::render('projects.show',['project'=>$project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return Inertia::render('projects.edit',['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
		$project->nombre = $request->input('nombre');
		$project->cliente = $request->input('cliente');
		$project->num_modulos = $request->input('num_modulos');
		$project->valor_tentativo = $request->input('valor_tentativo');
		$project->valor_acordado = $request->input('valor_acordado');
		$project->valor_primer_pago = $request->input('valor_primer_pago');
		$project->fecha_primera_reunion = $request->input('fecha_primera_reunion');
		$project->fecha_primer_pago = $request->input('fecha_primer_pago');
		$project->fecha_entrega = $request->input('fecha_entrega');
		$project->observaciones = $request->input('observaciones');
        $project->save();

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index');
    }
}
