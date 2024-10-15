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
        'nama_pendamping',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(ChildHistory::class);
    }

    public function saveHistory()
    {
        $this->histories()->create([
            'sudah_makan' => $this->sudah_makan,
            'sudah_minum_obat' => $this->sudah_minum_obat,
            'tanggal' => $this->tanggal ?? now(),
            'keterangan' => $this->keterangan,
            'nama_pendamping' => $this->nama_pendamping,
        ]);
    }
}
