<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uploads/fileUpload');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:zip,pdf,xlx,csv|max:2048',
        ]);
    
        $fileName = time().'.'.$request->file->extension();  
    
        /* 
            Store File

            // Store File in Storage Folder
            // storage/app/files/file.zip
            $request->image->storeAs('files', $fileName);

            // Store File in Public Folder
            // public/files/file.zip
            $request->image->move(public_path('files'), $fileName);

            // Store File in S3
            $request->image->storeAs('files', $fileName, 's3');
        */
     
        $request->file->move(public_path('uploads/files'), $fileName);
   
        /*  
            Write Code Here for
            Store $fileName name in DATABASE from HERE 
        */
     
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file', $fileName);
   
    }
}
