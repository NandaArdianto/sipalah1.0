<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Report extends Model
{
    protected $keyType = 'string'; // Menentukan tipe primary key
    public $incrementing = false; // Non-incrementing, karena UUID bukan angka

    protected static function boot()
    {
        parent::boot();

        // Secara otomatis generate UUID untuk setiap record yang dibuat
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    use HasFactory;

    // Tentukan field yang dapat diisi
    protected $fillable = [
        'perubahan',
        'latitude',
        'longitude',
        'foto',
        'keterangan',
        'nama_pelapor',
        'email',
        'nohp',
        'alamat',
        'status'
    ];
}
