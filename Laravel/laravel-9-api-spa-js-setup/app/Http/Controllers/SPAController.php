<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SPAController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if(Auth::check())
        {
            $data = [
                'configs' => [
                    'appName' => config('app.name'),
                    'locale' => app()->getLocale(),
                    'locales' => config('app.locales'),
                    'githubAuth' => config('services.github.client_id'),
                ],
                'AuthenticatedSession' => [
                    'isLoggedin' => true,
                    'currentUser' =>  Auth::user()
                ]
            ];
        }
        else
        {
            $data = [
                'configs' => [
                    'appName' => config('app.name'),
                    'locale' => app()->getLocale(),
                    'locales' => config('app.locales'),
                    'githubAuth' => config('services.github.client_id'),
                ],
                'AuthenticatedSession' => [
                    'isLoggedin' => false
                ]
            ];
        }

        return view('spa', $data);
    }
}
