<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparat extends Model
{
    use HasFactory;

    protected $table = "aparats";
    protected $primaryKey = "id";
    protected $fillable = [
        'wilayah_rts_id',
        'jabatans_id',
        'wargas_id',
    ];
    // protected $guarded = "id";

    /**
     * Get the warga that owns the Aparat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'wargas_id');
    }

    /**
     * Get the jabatan that owns the Aparat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatans_id');
    }
}
