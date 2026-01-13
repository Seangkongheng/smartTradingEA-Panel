<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\VideoStreamPartnerCommentFactory;

class VideoStreamPartnerComment extends Model
{
    use HasFactory;
    protected $table = 'stream_video_partner_comments';

    protected $primaryKey = 'id';

    protected $fillable = [
        'stream_video_partner_id',
        'name',
        'audio_path',
        'image',
        'description',
        'updated_at',
        'created_at',
    ];

    public function replies()
    {
        return $this->hasMany(VideoStreamPartnerReplyComment::class, 'stream_video_comment_id', 'id')
            ->with('replies'); // fetch recursively
    }
}
