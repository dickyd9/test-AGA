<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_employee', 'id'); // Sesuaikan kolom-kolomnya
    }

    protected $fillable = [
        'employee_name','gender','phone_number','nip','address'
    ];

    public $timestamps = false;

    protected $guarded = ['id', 'nip'];
}
