<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\StoreProjectRequest;


class ProjectController extends Controller
{
    public function index(){
        return ProjectResource::collection(Project::all());
    }

    public function store(StoreProjectRequest $request){
        Project::create($request->validated());
        return response()->json('Projeto criado');
    }

    public function update(StoreProjectRequest $request, Project $project){
        $project->update($request->validated());
        return response()->json("Project atualizado");
    }

    public function destroy(Project $project){
        $project->delete();
        return response()->json("Project deletado");
    }
}
