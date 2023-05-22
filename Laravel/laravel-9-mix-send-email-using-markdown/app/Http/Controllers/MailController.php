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
            'title' => 'Testing email using markdown',
            'url' => 'https://www.devpercode.com',
            'body' => 'This is for testing email using markdown.'
        ];
         
        Mail::to('xxxx@gmail.com')->send(new DemoMail($mailData));
           
        dd("Email is sent successfully.");
    }
}
