<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'id_level_user',
        'nomer_telepon',
        'alamat',
        'tanggal_lahir',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        
    ];

    protected $dates = ['deleted_at']; // Specify the column to use for soft deletes

    public function level_user()
    {
        return $this->belongsTo(level_user::class, 'id_level_user', 'id');
    }

    public function kalender_beasiswa()
    {
        return $this->hasMany(kalender_beasiswa::class, 'id_user', 'id');
    }

    public function softDeleteUser()
    {
        // Set the deleted_at timestamp to 30 days from now
        $this->deleted_at = $this->freshTimestamp()->addDays(30);
        $this->save();
    }

    /**
     * Restore the soft deleted user record.
     */
    public function restoreUser()
    {
        // Clear the deleted_at timestamp to restore the record
        $this->deleted_at = null;
        $this->save();
    }

    /**
     * Force delete (permanently delete) the user record.
     */
    public function forceDeleteUser()
    {
        // Perform the model's force delete
        return parent::forceDelete();
    }
}