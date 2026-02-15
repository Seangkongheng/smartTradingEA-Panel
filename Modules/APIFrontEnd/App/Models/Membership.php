<?php

namespace Modules\APIFrontEnd\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function approveBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
