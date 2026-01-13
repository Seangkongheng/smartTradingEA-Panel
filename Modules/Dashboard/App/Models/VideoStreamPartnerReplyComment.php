<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\VideoStreamPartnerReplyCommentFactory;

class VideoStreamPartnerReplyComment extends Model
{
    use HasFactory;


    protected $table = 'stream_video_partner_reply_comments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'stream_video_comment_id',
        'stream_video_partner_id',
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
        return $this->belongsTo(VideoStreamPartnerComment::class, 'stream_video_comment_id', 'id');
    }

    // Recursive replies
    public function replies()
    {
        return $this->hasMany(VideoStreamPartnerReplyComment::class, 'parent_id', 'id')->with('replies');
    }
}
