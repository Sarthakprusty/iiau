<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory;
    use softDeletes;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(Status::class, 'report_status', 'report_id', 'status_id')->withPivot(['id','remark','created_at','created_by']);
    }
}
