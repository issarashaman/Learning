<?php

namespace App\Http\Controllers\Consoles\Services\Line;

use App\Http\Controllers\ConsoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Service;
use App\Models\Services\ServiceLineLogin;

class LineLoginController extends ConsoleController
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
            'service_name' => ['required', 'string', 'max:100'],
            'channel_id' => ['required', 'string'],
            'channel_secret' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $service = new Service;
        $service->user_id = $user['user_id'];
        $service->project_id = $request['project_id'];
        $service->service_id = time();
        $service->service_type = $request['service_type'];
        $service->service_name = $validatedData['service_name'];

        $service->save();

        $service_line_login = new ServiceLineLogin;
        $service_line_login->service_id = $service->service_id;
        $service_line_login->channel_id = $validatedData['channel_id'];
        $service_line_login->channel_secret = $validatedData['channel_secret'];

        $service_line_login->save();
       
        return redirect('/console/service/'.$service->service_id)->with('success','Service created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($service_id)
    {
        $user = Auth::user();

        $service = Service::where('user_id', $user['user_id'])->where('service_id', $service_id)->first();

        if(!$service)
        {
            return abort(404);
        }

        $project = Project::where('user_id', $user['user_id'])->where('project_id', $service['project_id'])->first();

        $service_line_login = ServiceLineLogin::where('service_id', $service['service_id'])->first();

        if(!$service_line_login)
        {
            return abort(404);
        }

        return view('consoles.services.line.line-login.edit',compact('project', 'service', 'service_line_login'));
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
        //
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
