<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class ConsoleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $configs;
    private $currentUser;
    private $isLoggedin;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', function ($request, $next)
        {
            $this->configs = [
                'appName' => config('app.name'),
                'locale' => app()->getLocale(),
                'locales' => config('app.locales'),
                'githubAuth' => config('services.github.client_id'),
            ];

            $this->currentUser = Auth::user();
            $this->isLoggedin = Auth::check();

            view()->share('configs', $this->configs);
            view()->share('currentUser', $this->currentUser);
            view()->share('isLoggedin', $this->isLoggedin);
    
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
        return view('console');
    }
}
