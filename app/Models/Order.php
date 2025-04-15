<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_customer',
        'products',
        'members_id',
        'users_id',
        'tanggal_penjualan',
        'total_barang',
        'total_harga',
        'customer_pay',
        'customer_return',
        'member_point_used',
        'total_harga_after_point'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'members_id');
    }

}
