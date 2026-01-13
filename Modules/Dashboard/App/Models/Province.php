<?php

namespace Modules\Dashboard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Dashboard\Database\factories\ProvinceFactory;

class Province extends Model
{
    use HasFactory;

        public function schoolParter(){
        return $this->hasMany(SchoolPartner::class,'province_id');
    }

     protected $table = 'provinces';
    protected $primarykey = 'id';
    protected $fillable = [
        'kh_name',
        'en_name',
        'profile',
        'updated_at',
        'created_at'
    ];
}
