<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kbeasiswa',
    ];

    /**
     * Get the kalender_beasiswa associated with the wishlist item.
     */
    public function kalenderBeasiswa()
    {
        return $this->belongsTo(kalender_beasiswa::class, 'id_kbeasiswa');
    }
}
