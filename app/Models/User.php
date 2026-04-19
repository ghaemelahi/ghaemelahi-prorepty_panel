<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enumes\UserSystemRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'p_created_at',
        'p_updated_at',
        'system_roles',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function getSystemROlesUserAttribute()
    {
        switch ($this->system_roles) {
            case UserSystemRole::Admin->value:
                return 'مدیر';
            case UserSystemRole::Secretary->value:
                return 'منشی';
        }
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
        // $this->attributes['search_active'] = intval($value);
    }


    public function scopeSearchName($query, $search_name)
    {
        if (!empty($search_name)) {
            return  $query->where('name', "LIKE", "%$search_name%");
        }
    }
    

    public function scopeSearchEmaile($query, $search_email)
    {
        if (!empty($search_email)) {
            return  $query->where('name', "LIKE", "%$search_email%");
        }
    }
    

    public function scopeSearchRoles($query, $search_roles)
    {
        if (!empty($search_roles)) {
           return $query->whereIn('system_roles', $search_roles);
        }
    }
    

    public function scopeSearchActive($query, $search_active)
    {
            // dd(empty($search_active));
        if (!empty($search_active)) {
            return  $query->where('active', $search_active);
        }
    }
}
