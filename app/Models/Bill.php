<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customerId',
        'initial',
        'final',
        'month',
        'year',
        'units',
        'kwh_used',
        'amount',
        'status',
    ];

    protected $casts = [
        'initial' => 'integer',
        'final' => 'integer',
        'kwh_used' => 'integer',
        'total' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function totalUnpaidByCustomer($userId)
    {
        return self::where([
            ['user_id', $userId],
            ['status', 'Unpaid']
        ])->sum('amount');
    }

    public static function calculateTotalUnpaid($userId)
    {
        return self::where('user_id', $userId)
                    ->where('status', 'Unpaid')
                    ->sum('amount');
    }
}
