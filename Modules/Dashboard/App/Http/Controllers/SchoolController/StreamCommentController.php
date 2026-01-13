<?php

namespace Modules\Dashboard\App\Http\Controllers\SchoolController;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Dashboard\App\Models\SteamComment;
use Modules\Dashboard\App\Models\Stream;
use Modules\Dashboard\App\Models\StreamReplyComment;

class StreamCommentController extends Controller
{


    public function comment(Request $request)
    {
        $request->validate([
            'stream_id' => 'required|exists:streams,id',
            'name' => 'nullable|string',
            'comment' => 'nullable|string',
            'audio' => 'nullable|string',
            'image' => 'nullable|max:5120',
        ]);

        $audioPath = null;
         $imagePath = null;

        //Note : Handle image upload
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $filename = 'img_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('commentImages', $filename, 'public');
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                $imagePath = null;
            }
        }

        if ($request->audio) {
            $base64 = $request->audio;

            // Extract MIME type and base64 data
            if (preg_match('/^data:audio\/(\w+);base64,/', $base64, $matches)) {
                $ext = $matches[1]; // e.g., mp4, webm, mp3
                $audio = str_replace($matches[0], '', $base64);
                $audio = str_replace(' ', '+', $audio);
                $data = base64_decode($audio);

                // Force save as MP4
                $filename = 'voice_' . time() . '.mp4';
                $filePath = storage_path('app/public/comments/' . $filename);
                file_put_contents($filePath, $data);

                $audioPath = 'comments/' . $filename;
            }
        }

        // Save comment
        $comment = SteamComment::create([
            'stream_id' => $request->stream_id,
            'name' => $request->name,
            'description' => $request->comment,
            'audio_path' => $audioPath,
             'image' => $imagePath,
        ]);

        return response()->json([
            'comment' => [
                'name' => $comment->name,
                'description' => $comment->description,
                'audio_path' => $comment->audio_path,
                'created_at' => $comment->created_at->diffForHumans(),
                'avatar' => null,
            ]
        ]);
    }

    public function getComment($stream_id)
    {
        $comments = SteamComment::with('replies')->where('stream_id', $stream_id)->latest()->get();
        return response()->json(['comments' => $comments]);

    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:stream_comments,id',
            'stream_id' => 'required|exists:streams,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'audio' => 'nullable|string',
            'image' => 'nullable|max:5120',

        ]);

        $audioPath = null;
         $imagePath = null;

        //Note : Handle image upload
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $filename = 'img_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('commentImages', $filename, 'public');
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                $imagePath = null;
            }
        }

        if ($request->audio) {
            $base64 = $request->audio;

            // Extract MIME type and base64 data
            if (preg_match('/^data:audio\/(\w+);base64,/', $base64, $matches)) {
                $ext = $matches[1]; // mp4, webm, etc
                $audio = str_replace($matches[0], '', $base64);
                $audio = str_replace(' ', '+', $audio);
                $data = base64_decode($audio);

                // Temporary input file
                $tmpFile = storage_path('app/tmp_reply_audio.' . $ext);
                file_put_contents($tmpFile, $data);

                // Final MP4 path
                $filename = 'voice_' . time() . '.mp4';
                $filePath = storage_path('app/public/comments/' . $filename);

                // Convert WebM or other formats → MP4
                if ($ext !== 'mp4') {
                    exec("ffmpeg -y -i " . escapeshellarg($tmpFile) . " -c:a aac -b:a 128k " . escapeshellarg($filePath) . " 2>&1", $output, $returnVar);
                    unlink($tmpFile);
                    if ($returnVar !== 0) {
                        Log::error('FFmpeg conversion failed: ' . implode("\n", $output));
                        $audioPath = null;
                    } else {
                        $audioPath = 'comments/' . $filename;
                    }
                } else {
                    rename($tmpFile, $filePath);
                    $audioPath = 'comments/' . $filename;
                }
            }
        }

        // Save reply
        $reply = StreamReplyComment::create([
            'comment_id' => $request->comment_id,
            'stream_id' => $request->stream_id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'description' => $request->description,
            'audio_path' => $audioPath,
            'image'=>$imagePath,
        ]);

        $reply->parent_name = $request->parent_name ?? null;

        return response()->json(['reply' => $reply]);
    }

}
