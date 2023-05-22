<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $response = Http::withOptions([
                    'debug' => false,
                    'verify' => false,
                    ])->get('https://jsonplaceholder.typicode.com/posts');
    
        $jsonData = $response->json();
          
        //dd($jsonData);
    	  
    	echo "<pre> status:";
    	print_r($response->status());
    	echo "<br/> ok:";
    	print_r($response->ok());
        echo "<br/> successful:";
        print_r($response->successful());
        echo "<br/> serverError:";
        print_r($response->serverError());
        echo "<br/> clientError:";
        print_r($response->clientError());
        echo "<br/> headers:";
        print_r($response->headers());
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store()
    {
        $response = Http::withOptions([
                    'debug' => false,
                    'verify' => false,
                    ])->post('https://jsonplaceholder.typicode.com/posts', [
                        'title' => 'This is test from ItSolutionStuff.com',
                        'body' => 'This is test from ItSolutionStuff.com as body',
                    ]);
  
        $jsonData = $response->json();
      
        dd($jsonData);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update()
    {
        $response = Http::withOptions([
                    'debug' => false,
                    'verify' => false,
                    ])->put('https://jsonplaceholder.typicode.com/posts/1', [
                        'title' => 'This is test from ItSolutionStuff.com',
                        'body' => 'This is test from ItSolutionStuff.com as body',
                    ]);
  
        $jsonData = $response->json();
      
        dd($jsonData);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete()
    {
        $response = Http::withOptions([
                    'debug' => false,
                    'verify' => false,
                    ])->delete('https://jsonplaceholder.typicode.com/posts/1');
  
        $jsonData = $response->json();
      
        dd($jsonData);
    }
}
