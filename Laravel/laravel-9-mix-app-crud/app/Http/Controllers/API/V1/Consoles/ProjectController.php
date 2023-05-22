<?php

namespace App\Http\Controllers\API\V1\Consoles;

use App\Http\Controllers\ConsolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends ConsolesController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();
        
        $projects = Project::where('user_id', $currentUser->user_id)->get();

        return response()->json($projects);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project_name' => ['required', 'string', 'max:100'],
            'project_description' => ['max:255'],
        ]);

        $currentUser = Auth::user();

        $project = new Project;
        $project->user_id = $currentUser['user_id'];
        $project->project_id = time();
        $project->project_name = $validatedData['project_name'];
        $project->project_description = $validatedData['project_description'];

        $project->save();

        return response()->json($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentUser = Auth::user();
        
        $project = Project::where('user_id', $currentUser->user_id)->where('project_id', $id)->first();

        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'project_name' => ['required', 'string', 'max:100'],
            'project_description' => ['max:255'],
            'project_progress' => ['string'],
            'project_status' => ['string'],
        ]);

        $currentUser = Auth::user();

        $project = Project::where('user_id', $currentUser->user_id)->where('project_id', $id)->first();

        if(!$project)
        {
            return abort(404);
        }

        $project->project_name = $validatedData['project_name'];
        $project->project_description = $validatedData['project_description'];
        $project->project_progress = $validatedData['project_progress'];
        $project->project_status = $validatedData['project_status'];

        $project->save();
        
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser = Auth::user();

        $project = Project::where('user_id', $currentUser->user_id)->where('project_id', $id)->first();

        if(!$project)
        {
            return abort(404);
        }

        $project->delete();
    }
}
