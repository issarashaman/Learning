<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ConsolesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $currentUser;
    private $signed_in;
    private $projects;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', function ($request, $next)
        {
            $this->currentUser = Auth::user();
            $this->signed_in = Auth::check();
            $this->projects = Project::where('user_id', $this->currentUser->user_id)->get();

            //unset($this->currentUser->id);
    
            view()->share('currentUser', $this->currentUser);
            view()->share('signed_in', $this->signed_in);
            view()->share('projects', $this->projects);
    
            return $next($request);
        }]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.main');
    }
}
