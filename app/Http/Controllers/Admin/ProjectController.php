<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create',compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required', // Assumendo che l'immagine sia un URL, altrimenti cambia la regola di validazione
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'
        ]);   
                        
        $data = $request->all();

        $new_project = Project::create($data);

        if ($request->has('technologies')) {
            $new_project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // $project = Project::findOrFail();

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        
        return view('admin.projects.edit', compact('project', 'types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required', // Assumendo che l'immagine sia un URL, altrimenti cambia la regola di validazione
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id'
        ]);       
            

        $data = $request->all();

        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }
        

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
