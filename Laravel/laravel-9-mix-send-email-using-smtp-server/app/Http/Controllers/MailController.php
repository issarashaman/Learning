<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Testing email using smtp',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('isxxme@gmail.com')->send(new DemoMail($mailData));
           
        dd("Email is sent successfully.");
    }
}
