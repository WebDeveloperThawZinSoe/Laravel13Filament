<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'media';

    protected $fillable = [
        'name', 'file_name', 'mime_type', 'extension', 'disk', 'path', 'url',
        'size', 'type', 'width', 'height', 'duration',
        'collection', 'alt_text', 'description',
        'meta', 'uploaded_by', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'meta'       => 'array',
        'is_active'  => 'boolean',
        'size'       => 'integer',
        'width'      => 'integer',
        'height'     => 'integer',
        'duration'   => 'integer',
        'sort_order' => 'integer',
    ];

    protected $appends = ['human_size', 'is_image', 'is_video'];

    /* =========================================================
     |  CONSTANTS
     ========================================================= */
    public const TYPE_IMAGE    = 'image';
    public const TYPE_VIDEO    = 'video';
    public const TYPE_AUDIO    = 'audio';
    public const TYPE_DOCUMENT = 'document';
    public const TYPE_OTHER    = 'other';

    public const TYPES = [
        self::TYPE_IMAGE    => 'Image',
        self::TYPE_VIDEO    => 'Video',
        self::TYPE_AUDIO    => 'Audio',
        self::TYPE_DOCUMENT => 'Document',
        self::TYPE_OTHER    => 'Other',
    ];

    public const COLLECTIONS = [
        'brand'        => 'Brand / Logo',
        'hero'         => 'Hero',
        'services'     => 'Services',
        'promotions'   => 'Promotions',
        'testimonials' => 'Testimonials',
        'agent'        => 'Agent',
        'general'      => 'General',
    ];

    /* =========================================================
     |  RELATIONSHIPS
     ========================================================= */

    /**
     * The user who uploaded this media file.
     */
    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /* =========================================================
     |  SCOPES
     ========================================================= */
    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function scopeOfType($q, string $type)
    {
        return $q->where('type', $type);
    }

    public function scopeInCollection($q, string $collection)
    {
        return $q->where('collection', $collection);
    }

    /* =========================================================
     |  ACCESSORS
     ========================================================= */
    public function getHumanSizeAttribute(): string
    {
        $bytes = $this->size;
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)       return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' B';
    }

    public function getIsImageAttribute(): bool
    {
        return $this->type === self::TYPE_IMAGE;
    }

    public function getIsVideoAttribute(): bool
    {
        return $this->type === self::TYPE_VIDEO;
    }

    /* =========================================================
     |  HELPERS
     ========================================================= */
    public static function detectType(string $mime, string $extension): string
    {
        if (str_starts_with($mime, 'image/')) return self::TYPE_IMAGE;
        if (str_starts_with($mime, 'video/')) return self::TYPE_VIDEO;
        if (str_starts_with($mime, 'audio/')) return self::TYPE_AUDIO;

        $docExts = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv'];
        if (in_array(strtolower($extension), $docExts)) return self::TYPE_DOCUMENT;

        return self::TYPE_OTHER;
    }

    public function deleteFile(): bool
    {
        if ($this->path && Storage::disk($this->disk)->exists($this->path)) {
            return Storage::disk($this->disk)->delete($this->path);
        }
        return false;
    }

    protected static function booted(): void
    {
        // When record is force-deleted, remove file from disk
        static::forceDeleted(function (Media $media) {
            $media->deleteFile();
        });

        // When soft-deleted, keep the file — restore would need it.
    }
}