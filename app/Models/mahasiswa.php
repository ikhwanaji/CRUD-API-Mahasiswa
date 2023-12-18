<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    
    protected $fillable = ['nama','nim','jurusan','tanggal_lahir','alamat'];
}

?>