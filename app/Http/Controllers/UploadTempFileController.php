<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class UploadTempFileController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('image-', true);
            $image->storeAs('public/tmp/' . $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file' => $fileName
            ]);
            session()->push('folder',$folder);
            return $folder;
        }
        return '';
    }
}
