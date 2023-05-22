<?php

namespace App\Http\Controllers\Consoles;

use App\Http\Controllers\ConsoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Service;
use App\Models\Services\ServiceLineLogin;
use App\Models\Services\ServiceLineMessagingApi;

class ServiceController extends ConsoleController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project_id = $request->query('project');

        $service_type = $request->query('type');

        //$user = $request->user();
        $user = Auth::user();

        $project = Project::where('user_id', $user['user_id'])->where('project_id', $project_id)->first();

        //return response()->json($project);

        if($project_id && !$service_type || !$project_id && $service_type)
        {
            return abort(404);
        }
        elseif($project_id && $service_type == "line-login")
        {
            return view('consoles.services.line.line-login.create',compact('project'));
        }
        elseif($project_id && $service_type == "line-messaging-api")
        {
            return view('consoles.services.line.line-messaging-api.create',compact('project'));
        }
        elseif(!$project_id && !$service_type || $project_id && $service_type)
        {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($service_id)
    {
        $user = Auth::user();

        $service = Service::where('user_id', $user['user_id'])->where('service_id', $service_id)->first();

        if(!$service)
        {
            return abort(404);
        }

        $project = Project::where('user_id', $user['user_id'])->where('project_id', $service['project_id'])->first();

        if($service && $service['service_type'] === "line-login")
        {
            $service_line_login = ServiceLineLogin::where('service_id', $service['service_id'])->first();
            
            return view('consoles.services.line.line-login.show',compact('project', 'service', 'service_line_login'));
        }
        elseif($service && $service['service_type'] === "line-messaging-api")
        {
            $service_line_messaging_api = ServiceLineMessagingApi::where('service_id', $service['service_id'])->first();
            
            return view('consoles.services.line.line-messaging-api.show',compact('project', 'service', 'service_line_messaging_api'));
        }
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
    public function update(Request $request, $service_id)
    {
        $validatedData = $request->validate([
            'service_name' => ['required', 'string', 'max:100'],
        ]);

        $user = Auth::user();

        $service = Service::where('user_id', $user['user_id'])->where('service_id', $service_id)->first();

        if(!$service)
        {
            return abort(404);
        }

        $service->service_name = $validatedData['service_name'];

        $service->save();
       
        return redirect('/console/service/'.$service_id.'/basics')->with('success','Service update successfully.');
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
