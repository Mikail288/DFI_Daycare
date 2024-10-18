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
        'makan_pagi',
        'makan_siang',
        'makan_sore',
        'sudah_minum_obat',
        'tanggal',
        'keterangan',
        'nama_pendamping',
        'susu_pagi',
        'susu_siang',
        'susu_sore',
        'air_putih_pagi',
        'air_putih_siang',
        'air_putih_sore',
        'bak_pagi',
        'bak_siang',
        'bak_sore',
        'bab_pagi',
        'bab_siang',
        'bab_sore',
        'tidur_pagi',
        'tidur_siang',
        'tidur_sore',
        'kegiatan_outdoor',
        'kegiatan_outdoor_lainnya',
    ];

    protected $dates = ['tanggal'];

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
            'makan_pagi' => $this->makan_pagi,
            'makan_siang' => $this->makan_siang,
            'makan_sore' => $this->makan_sore,
            'sudah_minum_obat' => $this->sudah_minum_obat,
            'tanggal' => $this->tanggal ?? now(),
            'keterangan' => $this->keterangan,
            'nama_pendamping' => $this->nama_pendamping,
            'susu_pagi' => $this->susu_pagi,
            'susu_siang' => $this->susu_siang,
            'susu_sore' => $this->susu_sore,
            'air_putih_pagi' => $this->air_putih_pagi,
            'air_putih_siang' => $this->air_putih_siang,
            'air_putih_sore' => $this->air_putih_sore,
            'bak_pagi' => $this->bak_pagi,
            'bak_siang' => $this->bak_siang,
            'bak_sore' => $this->bak_sore,
            'bab_pagi' => $this->bab_pagi,
            'bab_siang' => $this->bab_siang,
            'bab_sore' => $this->bab_sore,
            'tidur_pagi' => $this->tidur_pagi,
            'tidur_siang' => $this->tidur_siang,
            'tidur_sore' => $this->tidur_sore,
        ]);
    }
}
