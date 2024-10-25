<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /**
     * Mass assigning the data
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'date',
        'image'
    ];

    /**
     * Function for belonging the task to user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
