<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_peminjaman',
        'tanggal_jatuh_tempo',
        'tanggal_pengembalian',
        'status',
        'denda_telat',
        'denda_hilang',
    ];

    protected $casts = [
    'tanggal_peminjaman' => 'datetime',
    'tanggal_jatuh_tempo' => 'datetime',
    'tanggal_pengembalian' => 'datetime',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}