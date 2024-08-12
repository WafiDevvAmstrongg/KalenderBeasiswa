<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class level_user extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama'];

    public function user()
    {
        return $this->hasMany(User::class, 'id_user', 'id');
    }
    public function softDeleteLevelUser()
    {
        // Set the deleted_at timestamp to 30 days from now
        $this->deleted_at = $this->freshTimestamp()->addDays(30);
        $this->save();
    }

    /**
     * Restore the soft deleted level_user record.
     */
    public function restoreLevelUser()
    {
        // Clear the deleted_at timestamp to restore the record
        $this->deleted_at = null;
        $this->save();
    }

    /**
     * Force delete (permanently delete) the level_user record.
     */
    public function forceDeleteLevelUser()
    {
        // Perform the model's force delete
        return parent::forceDelete();
    }
}