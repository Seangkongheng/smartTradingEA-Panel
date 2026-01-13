<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    protected $table = 'genders';
    protected $primarykey = 'id';
    protected $fillable = [
        'full_name',
        'gender_id',
        'province_id',
        'school_partner_id',
        'class_id',
        'created_at',
        'updated_at',
    ];
}
