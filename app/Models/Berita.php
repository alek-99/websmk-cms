<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Berita extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_id',
        'editor_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'reading_time',
        'featured_image',
        'featured_image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'robots',
        'structured_data',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'status',
        'published_at',
        'scheduled_at',
        'is_featured',
        'views',
    ];

    protected $casts = [
        'structured_data' => 'array',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'is_featured' => 'boolean',
        'views' => 'integer',
    ];

    protected $appends = ['reading_time_minutes', 'formatted_date'];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BeritaCategory::class, 'berita_category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'berita_tag');
    }

    public function analytics(): HasMany
    {
        return $this->hasMany(BeritaAnalytic::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '>', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePopular($query, $days = 30)
    {
        return $query->published()
                    ->where('published_at', '>=', now()->subDays($days))
                    ->orderByDesc('views');
    }

    public function scopeRecent($query, $limit = 5)
    {
        return $query->published()
                    ->latest('published_at')
                    ->limit($limit);
    }

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('categories', function($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    public function scopeByTag($query, $tagSlug)
    {
        return $query->whereHas('tags', function($q) use ($tagSlug) {
            $q->where('slug', $tagSlug);
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%");
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getReadingTimeMinutesAttribute()
    {
        if ($this->reading_time) {
            return $this->reading_time;
        }
        
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / 200); // Average reading speed
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at?->translatedFormat('d F Y');
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return Storage::url($this->featured_image);
        }
        return asset('images/default-news.jpg');
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return Str::limit(strip_tags($this->content), 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /*
    |--------------------------------------------------------------------------
    | Boot Methods
    |--------------------------------------------------------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            // Auto-generate slug
            if (!$berita->slug) {
                $berita->slug = Str::slug($berita->title);
            }

            // Set author if authenticated
            if (!$berita->author_id && Auth::check()) {
                $berita->author_id = Auth::id();
            }

            // Auto SEO fields
            if (!$berita->meta_title) {
                $berita->meta_title = $berita->title;
            }

            if (!$berita->meta_description) {
                $berita->meta_description = Str::limit(strip_tags($berita->content), 155);
            }

            // Calculate reading time
            if (!$berita->reading_time) {
                $wordCount = str_word_count(strip_tags($berita->content));
                $berita->reading_time = ceil($wordCount / 200);
            }

            // Set published_at for published status
            if ($berita->status === 'published' && !$berita->published_at) {
                $berita->published_at = now();
            }

            // Generate structured data
            $berita->structured_data = $berita->generateStructuredData();
        });

        static::updating(function ($berita) {
            // Update published_at when publishing
            if ($berita->isDirty('status') && $berita->status === 'published' && !$berita->published_at) {
                $berita->published_at = now();
            }

            // Recalculate reading time if content changed
            if ($berita->isDirty('content')) {
                $wordCount = str_word_count(strip_tags($berita->content));
                $berita->reading_time = ceil($wordCount / 200);
            }
        });

        static::deleting(function ($berita) {
            // Delete featured image
            if ($berita->featured_image) {
                Storage::disk('public')->delete($berita->featured_image);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function incrementViews()
    {
        $this->increment('views');
        
        // Track in analytics
        $this->trackAnalytics('view');
    }

    protected function trackAnalytics($type)
    {
        $today = now()->toDateString();
        
        $analytics = $this->analytics()->firstOrCreate(
            ['date' => $today],
            [
                'views' => 0,
                'unique_views' => 0,
                'shares' => 0,
                'avg_reading_time' => 0
            ]
        );

        if ($type === 'view') {
            $analytics->increment('views');
        }
    }

    public function generateStructuredData()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $this->title,
            'description' => $this->meta_description ?? Str::limit(strip_tags($this->content), 155),
            'image' => $this->featured_image ? asset('storage/' . $this->featured_image) : null,
            'datePublished' => $this->published_at?->toIso8601String(),
            'dateModified' => $this->updated_at?->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $this->author?->name ?? 'SMK Maulana Hasanudin'
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'SMK Maulana Hasanudin',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('storage/images/logo.png')
                ]
            ]
        ];
    }

    public function calculateSeoScore()
    {
        $score = 0;
        $maxScore = 100;
        $checks = [];

        // Title length (10 points)
        $titleLength = strlen($this->title);
        if ($titleLength >= 30 && $titleLength <= 60) {
            $score += 10;
            $checks['title_length'] = 'good';
        } else {
            $checks['title_length'] = 'improve';
        }

        // Meta description (10 points)
        if ($this->meta_description) {
            $descLength = strlen($this->meta_description);
            if ($descLength >= 120 && $descLength <= 155) {
                $score += 10;
                $checks['meta_description'] = 'good';
            } else {
                $score += 5;
                $checks['meta_description'] = 'improve';
            }
        } else {
            $checks['meta_description'] = 'missing';
        }

        // Featured image (10 points)
        if ($this->featured_image) {
            $score += 10;
            $checks['featured_image'] = 'good';
        } else {
            $checks['featured_image'] = 'missing';
        }

        // Alt text (10 points)
        if ($this->featured_image_alt) {
            $score += 10;
            $checks['image_alt'] = 'good';
        } else {
            $checks['image_alt'] = 'missing';
        }

        // Content length (15 points)
        $wordCount = str_word_count(strip_tags($this->content));
        if ($wordCount >= 300) {
            $score += 15;
            $checks['content_length'] = 'good';
        } elseif ($wordCount >= 150) {
            $score += 10;
            $checks['content_length'] = 'improve';
        } else {
            $checks['content_length'] = 'poor';
        }

        // Keywords in title (10 points)
        if ($this->meta_keywords) {
            $keywords = explode(',', $this->meta_keywords);
            $titleLower = strtolower($this->title);
            $keywordInTitle = false;
            
            foreach ($keywords as $keyword) {
                if (strpos($titleLower, strtolower(trim($keyword))) !== false) {
                    $keywordInTitle = true;
                    break;
                }
            }
            
            if ($keywordInTitle) {
                $score += 10;
                $checks['keyword_in_title'] = 'good';
            } else {
                $checks['keyword_in_title'] = 'improve';
            }
        } else {
            $checks['keyword_in_title'] = 'missing';
        }

        // Internal links (10 points)
        $internalLinks = substr_count(strtolower($this->content), route('welcome'));
        if ($internalLinks > 0) {
            $score += 10;
            $checks['internal_links'] = 'good';
        } else {
            $checks['internal_links'] = 'missing';
        }

        // Headings (10 points)
        $headings = preg_match_all('/<h[1-6]>/i', $this->content);
        if ($headings >= 3) {
            $score += 10;
            $checks['headings'] = 'good';
        } elseif ($headings > 0) {
            $score += 5;
            $checks['headings'] = 'improve';
        } else {
            $checks['headings'] = 'missing';
        }

        // Open Graph (10 points)
        if ($this->og_title && $this->og_description) {
            $score += 10;
            $checks['open_graph'] = 'good';
        } else {
            $checks['open_graph'] = 'improve';
        }

        // Canonical URL (5 points)
        if ($this->canonical_url) {
            $score += 5;
            $checks['canonical'] = 'good';
        } else {
            $checks['canonical'] = 'missing';
        }

        return [
            'score' => $score,
            'max_score' => $maxScore,
            'percentage' => round(($score / $maxScore) * 100),
            'checks' => $checks,
            'rating' => $this->getSeoRating($score)
        ];
    }

    protected function getSeoRating($score)
    {
        if ($score >= 80) return 'excellent';
        if ($score >= 60) return 'good';
        if ($score >= 40) return 'fair';
        return 'poor';
    }

    public function getRelatedNews($limit = 3)
    {
        $categoryIds = $this->categories()->pluck('id');
        $tagIds = $this->tags()->pluck('id');

        return static::published()
            ->where('id', '!=', $this->id)
            ->where(function($query) use ($categoryIds, $tagIds) {
                $query->whereHas('categories', function($q) use ($categoryIds) {
                    $q->whereIn('berita_category_id', $categoryIds);
                })->orWhereHas('tags', function($q) use ($tagIds) {
                    $q->whereIn('tag_id', $tagIds);
                });
            })
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }
}