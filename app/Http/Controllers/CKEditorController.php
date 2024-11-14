<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CKEditorController extends Controller
{
    public function upload(Request $request)
{
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads', $filename, 'public');

        return response()->json([
            'uploaded' => true,
            'url' => asset('storage/' . $path)
        ]);
    }

    return response()->json(['uploaded' => false, 'error' => 'Upload failed.']);
}

}
