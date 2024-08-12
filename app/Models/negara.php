<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class negara extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at']; // Specify the column to use for soft deletes
    protected $fillable = ['nama', 'id_benua'];

    public function benua()
    {
        return $this->belongsTo(benua::class, 'id_benua', 'id');
    }

    public function kalender_beasiswa()
    {
        return $this->belongsToMany(kalender_beasiswa::class, 'knegaras', 'id_negara', 'id_kbeasiswa')
            ->withPivot('deleted_at')
            ->withTimestamps()
            ->using(Knegara::class); // Ensure using the correct pivot model
    }

    /**
     * Perform soft delete with a 30-day time limit.
     *
     * @return void
     */
    public function softDeleteNegara()
    {
        // Soft delete related records if needed
        // $this->negara()->delete();

        // Set the deleted_at timestamp to 30 days from now
        $this->deleted_at = $this->freshTimestamp()->addDays(30);
        $this->save();
    }

    /**
     * Restore the soft deleted negara record.
     *
     * @return void
     */
    public function restoreNegara()
    {
        // Restore related records if needed
        // $this->negara()->restore();

        // Clear the deleted_at timestamp to restore the record
        $this->deleted_at = null;
        $this->save();
    }

    /**
     * Force delete (permanently delete) the negara record.
     *
     * @return bool|null
     */
    public function forceDeleteNegara()
    {
        // Force delete related records if needed
        // $this->negara()->forceDelete();

        // Perform the model's force delete
        return parent::forceDelete();
    }
}