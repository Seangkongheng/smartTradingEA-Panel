<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\StreamStatusFactory;

class StreamStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'stream_status';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
    ];
    
    protected static function newFactory()
    {
        //return StreamStatusFactory::new();
    }
}
