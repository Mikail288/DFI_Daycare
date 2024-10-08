<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'sudah_makan',
        'sudah_minum_obat',
        'tanggal',
        'keterangan',
    ];

    protected $casts = [
        'sudah_makan' => 'boolean',
        'sudah_minum_obat' => 'boolean',
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
