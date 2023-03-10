<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = "wargas";
    protected $primaryKey = "id";
    protected $fillable = [
        'wilayah_rts_id',
        'nik',
        'no_kk',
        'nama_warga',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'pekerjaan',
        'kewarganegaraan',
        'no_telp',
        'status_akun',
        'aparat',
    ];

    protected $guarded = ['id'];

    /**
     * Get the user associated with the Warga
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(Warga::class);
    }

    /**
     * Get the wilayah_rt that owns the Warga
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wilayah_rt()
    {
        return $this->belongsTo(Wilayah_rt::class, 'wilayah_rts_id');
    }

    /**
     * Get the aparat associated with the Warga
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aparat()
    {
        return $this->hasOne(Aparat::class);
    }
}
