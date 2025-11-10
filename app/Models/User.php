<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'phone',
        'branch_id',
        'role_id',
        'is_active',
        'last_login_at',
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

    // Relasi ke cabang
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->username)) {
                $base = strtolower(str_replace(' ', '_', $user->name));
                $count = static::where('username', 'like', "{$base}%")->count();
                $user->username = $count > 0 ? "{$base}_{$count}" : $base;
            }
        });
    }

    public function roles(): BelongsToMany
    {
        // gunakan pivot user_roles
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')
                    ->withPivot('assigned_at');
    }


    // Relasi ke log aktivitas
    public function logs()
    {
        return $this->hasMany(UserLog::class);
    }

    public function tokens()
    {
        return $this->morphMany(\Laravel\Sanctum\PersonalAccessToken::class, 'tokenable');
    }

    // Relasi ke perangkat login
    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_active; // Hanya user aktif yang bisa masuk admin panel
    }
}
