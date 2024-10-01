<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanHeader extends Model
{
    protected $table = 'penjualan_header';
    protected $guarded = [
        'id', 'created_at'
    ];
}
