<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\FooterFactory;

class Footer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'footers';
    protected $primarykey = 'id';
    protected $fillable = [
        'copyright',
        'description',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return ContactFactory::new();
    }

}
