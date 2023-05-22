<?php

namespace App\Http\Controllers\Consoles;

use App\Http\Controllers\ConsoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Service;

class ProjectController extends ConsoleController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consoles.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consoles.projects.create');
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
        ]);

        $user = Auth::user();

        $project = new Project;
        $project->user_id = $user['user_id'];
        $project->project_id = time();
        $project->project_name = $validatedData['project_name'];

        $project->save();
       
        return redirect('/console/project/'.$project->project_id)->with('success','Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id)
    {
        $user = Auth::user();

        $project = Project::where('user_id', $user['user_id'])->where('project_id', $project_id)->first();

        if(!$project)
        {
            return abort(404);
        }

        $services = Service::where('project_id', $project['project_id'])->get();

        //return response()->json($services);
        return view('consoles.projects.show',compact('project', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id)
    {
        $user = Auth::user();

        $project = Project::where('user_id', $user['user_id'])->where('project_id', $project_id)->first();

        if(!$project)
        {
            return abort(404);
        }

        return view('consoles.projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id)
    {
        $validatedData = $request->validate([
            'project_name' => ['required', 'string', 'max:100'],
        ]);

        $user = Auth::user();

        $project = Project::where('user_id', $user['user_id'])->where('project_id', $project_id)->first();

        if(!$project)
        {
            return abort(404);
        }

        $project->project_name = $validatedData['project_name'];

        $project->save();
       
        return redirect('/console/project/'.$project_id.'/settings')->with('success','Project update successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roles($project_id)
    {
        $user = Auth::user();

        $project = Project::where('user_id', $user['user_id'])->where('project_id', $project_id)->first();

        return view('consoles.projects.roles',compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
