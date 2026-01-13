<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\App\Models\SteamComment;
use Modules\Dashboard\Database\factories\StreamReplyCommentFactory;

class StreamReplyComment extends Model
{
    use HasFactory;

    protected $table = 'stream_reply_comments';
    protected $primarykey = 'id';
    protected $fillable = [
        'comment_id',
        'stream_id',
        'parent_id',
        'audio_path',
        'image',
        'name',
        'description',
        'updated_at',
        'created_at',
    ];
    public function comment()
    {
        return $this->belongsTo(SteamComment::class, 'comment_id', 'id');
    }

    // Recursive replies
    public function replies()
    {
        return $this->hasMany(StreamReplyComment::class, 'parent_id', 'id')
                    ->with('replies'); // recursive fetch
    }


}
