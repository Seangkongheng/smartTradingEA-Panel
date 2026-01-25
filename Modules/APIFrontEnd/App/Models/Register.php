<?php

namespace Modules\APIFrontEnd\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\APIFrontEnd\Database\factories\RegisterFactory;

class Register extends Model
{
    use HasFactory;

    protected $table = 'registers';
    protected $primarykey = 'id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];
}
