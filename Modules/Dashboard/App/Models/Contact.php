<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ContactFactory;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'contacts';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'icon',
        'value',
        'updated_at',
        'created_at'
    ];

    protected static function newFactory()
    {
        //return ContactFactory::new();
    }
}
