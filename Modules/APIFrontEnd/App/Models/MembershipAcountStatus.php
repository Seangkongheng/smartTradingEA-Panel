<?php

namespace Modules\APIFrontEnd\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\APIFrontEnd\Database\factories\MembershipAcountStatusFactory;

class MembershipAcountStatus extends Model
{
    use HasFactory;

   protected $table = 'membership_account_status';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
    ];
}
