<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TeacherCertificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'title',
        'issuer',
        'image',
        'image_alt',
        'description',
        'sort_order',
        'status',
    ];

    /**
     * Get the teacher that owns the certificate.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the full URL for the certificate image.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('teacher_certificates')->exists($this->image)) {
            return Storage::disk('teacher_certificates')->url($this->image);
        }

        return asset('assets/images/placeholder-certificate.jpg');
    }

    /**
     * Scope a query to only include active certificates.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to order certificates by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

}
