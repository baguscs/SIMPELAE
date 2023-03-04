<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah_rt extends Model
{
    use HasFactory;

    protected $table = "wilayah_rts";
    protected $fillable = [
        'wilayah'
    ];
    protected $guarded = ['id'];

    /**
     * Get the warga associated with the Wilayah_rt
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function warga()
    {
        return $this->hasOne(Warga::class);
    }
}
