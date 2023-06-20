<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class DeleteTempFileController extends Controller
{
    public function __invoke(Request $request)
    {
        $temporaryImage = TemporaryFile::where('folder', request()->getContent())->get();
        if ($temporaryImage) {
            Storage::deleteDirectory('public/tmp/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        //return response()->noContent();
        return request()->getContent();
    }
}
