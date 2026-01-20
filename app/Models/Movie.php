<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'synopsis',
        'genre',
        'release_year',
        'director',
        'duration',
        'rental_price',
        'stock',
        'available',
        'cover_image',
        'added_by'
    ];

    protected $casts = [
        'available' => 'boolean',
        'rental_price' => 'decimal:2',
        'release_year' => 'integer',
        'stock' => 'integer'
    ];

    
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    
    public function rentedBy()
    {
        return $this->belongsToMany(User::class, 'rentals')
                    ->withPivot(['rental_date', 'due_date', 'return_date', 'total_amount', 'status'])
                    ->withTimestamps();
    }

    
    public function isAvailable()
    {
        return $this->available && $this->stock > 0;
    }

    
    public function decreaseStock()
    {
        $this->decrement('stock');
        if ($this->stock <= 0) {
            $this->available = false;
            $this->save();
        }
    }

    
    public function increaseStock()
    {
        $this->increment('stock');
        if ($this->stock > 0 && !$this->available) {
            $this->available = true;
            $this->save();
        }
    }

    
    public function getCoverImageUrl()
    {
        if ($this->cover_image && str_starts_with($this->cover_image, 'http')) {
            return $this->cover_image;
        }
        
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        
        
        return 'https://via.placeholder.com/300x450?text=' . urlencode($this->title);
    }
}