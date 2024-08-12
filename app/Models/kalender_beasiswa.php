<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class kalender_beasiswa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'kalender_beasiswas';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'tanggal_registrasi',
        'deadline',
        'judul',
        'nama',
        'deskripsi',
        'jurusan',
        'jenis_beasiswa',
        'keuntungan',
        'umur',
        'gpa',
        'tes_english',
        'tes_bahasa_lain',
        'tes_standard',
        'dokumen',
        'lainnya',
        'link_pendaftaran',
        'status_tampil'
    ];

    /**
     * Define the relationship with Negara (Country) model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function negara()
    {
        return $this->belongsToMany(Negara::class, 'knegaras', 'id_kbeasiswa', 'id_negara')->withPivot('deleted_at')->withTimestamps();
    }

    /**
     * Define the relationship with tingkat_studi (Study Level) model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tingkat_studi()
    {
        return $this->belongsToMany(tingkat_studi::class, 'ktingkat_studis', 'id_kbeasiswa', 'id_tingkat_studi')->withPivot('deleted_at')->withTimestamps();
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id_kbeasiswa');
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
                DB::table('knegaras')
                    ->where('id_kbeasiswa', $model->id)
                    ->update(['deleted_at' => now()]);

                DB::table('ktingkat_studis')
                    ->where('id_kbeasiswa', $model->id)
                    ->update(['deleted_at' => now()]);

                // Soft delete the main model
                $model->deleted_at = $model->freshTimestamp()->addDays(30);
                $model->save();

                return false; // Prevents the model from being actually deleted from the database
            } else {
                // Force delete related pivot records
                DB::table('knegaras')
                    ->where('id_kbeasiswa', $model->id)
                    ->delete();

                DB::table('ktingkat_studis')
                    ->where('id_kbeasiswa', $model->id)
                    ->delete();
            }
        });

        static::restoring(function ($model) {
            // Restore related pivot records
            DB::table('knegaras')
                ->where('id_kbeasiswa', $model->id)
                ->update(['deleted_at' => null]);

            DB::table('ktingkat_studis')
                ->where('id_kbeasiswa', $model->id)
                ->update(['deleted_at' => null]);
        });

        
    }
}