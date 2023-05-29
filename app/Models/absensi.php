<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
        public $table = "absensi";

        use HasFactory;

        protected $fillable = [
            'ket',
            'tgl',
            'nilai',
            'kelas',
            'siswa_id',
            'tahun_ajaran',
        ];
        public function siswa()
        {
            return $this->belongsTo(Siswa::class, 'siswa_id','id' );
        }
        public function kelases()
        {
            return $this->belongsTo(Kelas::class, 'kelas','id' );
        }
        public function tahuns()
        {
            return $this->belongsTo(Tapel::class, 'tahun_ajaran','id' );
        }
}
