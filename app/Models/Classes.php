<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    use HasFactory;

    protected $table = 'classes'; 

    protected $primaryKey = 'id_kelas'; 
    
    protected $fillable = ['kelas', 'jurusan'];

    public $timestamps = false; 

    public function mbgs()
    {
        return $this->hasMany(Mbg::class, 'id_kelas', 'id_kelas');
    }
}

