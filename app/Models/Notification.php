<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'judul', 'konten', 'tipe', 'mulai_aktif', 'selesai_aktif'
    ];
}

