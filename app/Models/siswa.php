<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class siswa extends Model
{
    public $table = "siswa";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_induk',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'kelas',
        'wali',
        'tahun_ajaran',
        'foto',
    ];

    public function kelases()
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'id');
    }

    public function tapel()
    {
        return $this->belongsTo(Tapel::class, 'tahun_ajaran', 'id');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\siswa');
    }
}
