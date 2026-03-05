<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token_id',
        'jumlah',
        'total_harga',
    ];

    /**
     * Relasi ke user (pembeli token)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke token (produk listrik yang dibeli)
     */
    public function token()
    {
        return $this->belongsTo(Token::class);
    }

public function confirmation()
{
    return $this->hasOne(\App\Models\Confirmation::class);
}

}
