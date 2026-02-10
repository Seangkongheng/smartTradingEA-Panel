<?php

namespace Modules\APIFrontEnd\App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\APIFrontEnd\Database\factories\MembershipFactory;
use Modules\APIFrontEnd\App\Models\MembershipAccount;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'memberships';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'exness_email',
        'exness_email_status',
        'tradingview_username',
        'tradingview_status',
        'status',
        'note',
        'license_key',
        'submitted_at',
        'approved_by',
        'rejected_by',
        'approved_at',
        'rejected_at',
        'created_at',
        'updated_at',
    ];
    public function accounts()
    {
        return $this->hasMany(MembershipAccount::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     protected static function newFactory()
    {
        return MembershipFactory::new();
    }
}
