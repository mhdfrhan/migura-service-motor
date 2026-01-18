<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'action',
		'model_type',
		'model_id',
		'old_values',
		'new_values',
		'ip_address',
		'user_agent',
	];

	protected $casts = [
		'old_values' => 'array',
		'new_values' => 'array',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function scopeForModel($query, string $modelType, int $modelId)
	{
		return $query->where('model_type', $modelType)
			->where('model_id', $modelId);
	}

	public function scopeRecent($query)
	{
		return $query->orderBy('created_at', 'desc');
	}
}
