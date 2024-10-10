<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildHistory extends Model
{
    use HasFactory;

    protected $table = 'child_history';

    protected $fillable = [
        'child_id',
        'sudah_makan',
        'sudah_minum_obat',
        'tanggal',
        'keterangan',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
