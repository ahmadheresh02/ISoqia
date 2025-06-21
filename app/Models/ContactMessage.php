<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'title',
        'description',
        'phone',
        'package',
        'is_visible',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'is_visible' => 'boolean'
    ];

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }
}
