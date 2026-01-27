<?php

namespace Modules\APIFrontEnd\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Dashboard\App\Models\Attachment;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attachments = Attachment::orderBy('id', 'desc')->where('is_public', 1)->get();

        return response()->json([
            'attachments' => $attachments
        ]);
    }
    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);
        $files = json_decode($attachment->file, true);
        $file = $files[0];

        $path = storage_path('app/' . $file['path']);

        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        return response()->download($path, $file['name']);
    }



}
