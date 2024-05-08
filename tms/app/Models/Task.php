<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'description',
        'task_status_id',
        'created_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task_statuses()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id');
    }
}
