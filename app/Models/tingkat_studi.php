<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class tingkat_studi extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at']; // Specify the column to use for soft deletes
    protected $fillable = ['nama'];
    protected $softDeleteDays = 30; // Custom time limit for soft delete

    public function kalender_beasiswa()
    {
        return $this->belongsToMany(kalender_beasiswa::class, 'ktingkat_studis', 'id_tingkat_studi', 'id_kbeasiswa')
                    ->withPivot('deleted_at')
                    ->withTimestamps()
                    ->using(tingkat_studi::class); // Ensure using the correct pivot model
    }

    // Soft delete the TingkatStudi record with a 30-day time limit
    public function softDeleteTingkatStudi()
    {
        $this->deleted_at = $this->freshTimestamp()->addDays($this->softDeleteDays);
        $this->save();
    }

    // Restore the soft-deleted TingkatStudi record
    public function restoreTingkatStudi()
    {
        $this->restore();
    }

    // Force delete (permanently delete) the TingkatStudi record
    public function forceDeleteTingkatStudi()
    {
        $this->forceDelete();
    }

    /**
     * Boot function for the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (!$model->forceDeleting) {
                // Soft delete related pivot records
                DB::table('ktingkat_studis')
                    ->where('id_tingkat_studi', $model->id)
                    ->update(['deleted_at' => now()]);

                // Soft delete the main model
                $model->deleted_at = $model->freshTimestamp()->addDays($model->softDeleteDays);
                $model->save();

                return false; // Prevents the model from being actually deleted from the database
            } else {
                // Force delete related pivot records
                DB::table('ktingkat_studis')
                    ->where('id_tingkat_studi', $model->id)
                    ->delete();
            }
        });

        static::restoring(function ($model) {
            // Restore related pivot records
            DB::table('ktingkat_studis')
                ->where('id_tingkat_studi', $model->id)
                ->update(['deleted_at' => null]);
        });
    }
}