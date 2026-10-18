<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class LandingContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section', 'item_key', 'title', 'subtitle', 'content',
        'image_url', 'link_url', 'link_text', 'icon',
        'value', 'extra_value', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public const SECTION_BRAND        = 'brand';
    public const SECTION_HERO         = 'hero';
    public const SECTION_STATS        = 'stats';
    public const SECTION_SERVICES     = 'services';
    public const SECTION_STEPS        = 'steps';
    public const SECTION_PROMOTIONS   = 'promotions';
    public const SECTION_TESTIMONIALS = 'testimonials';
    public const SECTION_AGENT        = 'agent';
    public const SECTION_CONTACT      = 'contact';
    public const SECTION_FOOTER       = 'footer';

    public const SECTIONS = [
        self::SECTION_BRAND, self::SECTION_HERO, self::SECTION_STATS,
        self::SECTION_SERVICES, self::SECTION_STEPS, self::SECTION_PROMOTIONS,
        self::SECTION_TESTIMONIALS, self::SECTION_AGENT, self::SECTION_CONTACT,
        self::SECTION_FOOTER,
    ];

    /* =========================================================
     |  SCOPES
     ========================================================= */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSection($query, string $section)
    {
        return $query->where('section', $section);
    }

    /* =========================================================
     |  CACHE INVALIDATION
     ========================================================= */
    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('landing_content'));
        static::deleted(fn () => Cache::forget('landing_content'));
        static::restored(fn () => Cache::forget('landing_content'));
    }
}