<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Benua extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'benuas'; // Specify the correct table name
    protected $dates = ['deleted_at']; // Specify the column to use for soft deletes
    protected $fillable = ['nama'];

    /**
     * Relationship with Negara (Country) model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function negara()
    {
        return $this->hasMany(Negara::class, 'id_benua', 'id');
    }

    /**
     * Perform soft delete on the benua record.
     *
     * @return void
     */
    public function softDeleteBenua()
    {
        // Set the deleted_at timestamp to 30 days from now
        $this->deleted_at = now()->addDays(30);
        $this->save();
    }

    /**
     * Restore the soft deleted benua record.
     *
     * @return void
     */
    public function restoreBenua()
    {
        $this->restore();
    }

    /**
     * Force delete (permanently delete) the benua record.
     *
     * @return bool|null
     */
    public function forceDeleteBenua()
    {
        return $this->forceDelete();
    }
}