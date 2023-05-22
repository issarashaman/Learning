<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uploads/imageUpload');
    }
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      
        $imageName = time().'.'.$request->image->extension();  
    
        /* 
            Store Image

            // Store Image in Storage Folder
            // storage/app/images/file.png
            $request->image->storeAs('images', $imageName);

            // Store Image in Public Folder
            // public/images/file.png
            $request->image->move(public_path('images'), $imageName);

            // Store Image in S3
            $request->image->storeAs('images', $imageName, 's3');
        */
     
        $request->image->move(public_path('uploads/images'), $imageName);
    
        /* 
            Write Code Here for
            Store $imageName name in DATABASE from HERE 
        */
      
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}
