<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
protected $fillable = [
    'metode',
    'nama_bank',
    'nomor_tujuan',
    'nama_penerima',
    'gambar_qris',
    'keterangan',
];

}
