<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    
    protected $table = 'cuti';
    protected $primaryKey = 'id';
    protected $foreignKey = 'id_employee';
    
    // Definisikan relasi dengan model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_employee', 'id');
    }

    protected $fillable = [
        'id_employee', 'cuti_date','lama_cuti','keterangan'
    ];

    public $timestamps = false;

}
