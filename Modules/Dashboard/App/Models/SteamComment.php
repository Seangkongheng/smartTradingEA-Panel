<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\SteamCommentFactory;

class SteamComment extends Model
{
    use HasFactory;
    protected $table = 'stream_comments';
    protected $primarykey = 'id';
    protected $fillable = [
        'stream_id',
        'name',
        'image',
        'audio_path',
        'description',
        'updated_at',
        'created_at',
    ];

    public function replies()
    {
        return $this->hasMany(StreamReplyComment::class, 'comment_id', 'id')
                    ->with('replies'); // fetch recursively
    }

    protected static function newFactory()
    {

    }

}



