<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table="mahasiswas";
    public $timestamps= false; 
    protected $primaryKey = 'nim';

    protected $fillable = [
    'nim',
    'nama',
    'tgl_lahir',
    'kelas_id',
    'jurusan',
    'email',
    'no_hp',
    ];
}
