<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pending15 extends Model
{
    use HasFactory;
    public $table = 'pending_15';
    use SoftDeletes;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
