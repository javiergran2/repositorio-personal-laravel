<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'dni',
        'phone',
        'address',
        'birth_date',
        'membership_type',
        'membership_expires_at',
        'balance',
        'max_rentals',
        'is_active',
        'verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'membership_expires_at' => 'date',
        'balance' => 'decimal:2',
        'is_active' => 'boolean',
        'verified' => 'boolean'
    ];

    
    public function canRentMore()
    {
       
        $activeRentals = $this->rentals()->where('status', 'active')->count();
        return $activeRentals < $this->max_rentals;
    }

   
    public function hasActiveMembership()
    {
        if (!$this->membership_expires_at) {
            return false;
        }
        return Carbon::now()->lessThanOrEqualTo($this->membership_expires_at);
    }

    
    public function getAge()
    {
        return $this->birth_date ? Carbon::parse($this->birth_date)->age : null;
    }

    
    public function getStatusBadge()
    {
        if (!$this->is_active) {
            return '<span class="badge bg-danger">Inactivo</span>';
        }
        
        if (!$this->verified) {
            return '<span class="badge bg-warning">Pendiente</span>';
        }
        
        return '<span class="badge bg-success">Activo</span>';
    }

    
    public function getMembershipBadge()
    {
        $colors = [
            'basic' => 'secondary',
            'premium' => 'primary'
        ];
        
        $color = $colors[$this->membership_type] ?? 'secondary';
        $text = $this->membership_type == 'premium' ? 'Premium' : 'Básica';
        
        if ($this->hasActiveMembership()) {
            return '<span class="badge bg-' . $color . '">' . $text . '</span>';
        } else {
            return '<span class="badge bg-secondary">Expirada</span>';
        }
    }

    
    public function toggleStatus()
    {
        $this->update(['is_active' => !$this->is_active]);
        return $this->is_active;
    }

    
    public function verify()
    {
        $this->update(['verified' => true]);
    }
}