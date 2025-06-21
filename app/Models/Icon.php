<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    /**
     * Get the full URL for the icon
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    /**
     * Get the storage path for the icon
     */
    public function getStoragePathAttribute()
    {
        return 'public/' . $this->path;
    }
}
