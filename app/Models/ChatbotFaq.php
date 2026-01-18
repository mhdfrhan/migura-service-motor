<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotFaq extends Model
{
    protected $fillable = [
        'category',
        'question',
        'answer',
        'keywords',
        'view_count',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'keywords' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('question');
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }
}
