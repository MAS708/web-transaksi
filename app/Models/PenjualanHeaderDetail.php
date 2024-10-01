<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanHeaderDetail extends Model
{
    protected $table = 'penjualan_header_detail';
    protected $guarded = [
        'id', 'created_at'
    ];

    public function master_barang()
    {
        return $this->belongsTo('App\Models\MasterBarang', 'kode_barang_id', 'kode_barang');
    }

    public function promo()
    {
        return $this->belongsTo('App\Models\Promo', 'kode_promo_id', 'kode_promo');
    }
}
