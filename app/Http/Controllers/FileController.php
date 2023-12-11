<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\ResponseHelper;

 

class FileController extends Controller
{
    public function upload(Request $request)
     {
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $fileName = time() . '-' . $file->getClientOriginalName();
            
            $file->move(public_path('/'), $fileName);

            return ResponseHelper::success(['path' =>  $fileName], 200);
        }

        return ResponseHelper::error('File upload error', 500);
    }

    public function delete(Request $request)
       {
        $filename = $request->input('path');

        $filePath = public_path($filename);

        if (file_exists($filePath)) {
            unlink($filePath);
            return ResponseHelper::success('File deleted', 200);
        }

        return ResponseHelper::error('File not found', 404);
    }
}
