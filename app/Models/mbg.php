<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbg extends Model
{
    use HasFactory;

    protected $table = 'mbgs';
    protected $primaryKey = 'id_mbg';
    protected $fillable = [
        'id_kelas', 'date', 'foto', 'total_hadir', 
        'diambil', 'dikembalikan', 'total_siswa'
    ];

    public function Classes()
    {
        return $this->belongsTo(Classes::class, 'id_kelas', 'id_kelas');
    }
}
