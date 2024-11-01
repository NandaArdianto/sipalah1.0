<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geodata extends Model
{
    use HasFactory;

    protected $table = 'geodata'; // Pastikan sesuai dengan nama tabel
    protected $fillable = ['nama', 'geojson'];

    protected $attributes = [
        'nama' => 'Unnamed Polygon',  // Nilai default untuk kolom 'nama'
    ];
}
