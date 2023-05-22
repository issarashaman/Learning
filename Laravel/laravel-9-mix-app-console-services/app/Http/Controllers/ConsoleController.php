<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ConsoleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $user;
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
            $this->user = Auth::user();
            $this->signed_in = Auth::check();
            $this->projects = Project::where('user_id', $this->user->user_id)->get();

            unset($this->user->id);
    
            view()->share('currentUser', $this->user);
            view()->share('signed_in', $this->signed_in);
            view()->share('projects', $this->projects);
    
            return $next($request);
        }]);
    }
}
