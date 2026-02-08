<?php

namespace Modules\APIFrontEnd\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\APIFrontEnd\Database\factories\MembershipAccountFactory;

class MembershipAccount extends Model
{
    use HasFactory;

     protected $table = 'membership_accounts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'membership_id',
        'account_number',
        'status',
        'created_at',
        'updated_at',
    ];
}
