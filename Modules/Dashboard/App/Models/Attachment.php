<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\AttachmentFactory;

class Attachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */


    protected $table = 'attachments';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'description',
        'file',
        'type_file',
        'total_downloads',
        'is_public',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return AttachmentFactory::new();
    }
}
