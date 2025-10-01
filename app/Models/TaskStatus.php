<?php

namespace App\Models;

use App\Enums\TaskStatusColors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'color',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'created_at' => 'timestamp',
            'updated_at' => 'timestamp',
            'color' => TaskStatusColors::class,
        ];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
