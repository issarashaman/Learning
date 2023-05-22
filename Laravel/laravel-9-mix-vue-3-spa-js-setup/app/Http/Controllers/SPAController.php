<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = [
            'configs' => [
                'appName' => config('app.name'),
                'appURL' => config('app.url'),
                'locale' => app()->getLocale(),
                'locales' => config('app.locales'),
                'githubAuth' => config('services.github.client_id'),
            ]
        ];

        return view('spa', $data);
    }
}
