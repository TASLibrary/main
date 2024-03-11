<?php

namespace App\Models;

use App\Enum\MedalStatus;
use App\Enum\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'affiliation', 'role', 'active', 'rating'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Lists Usecases
     * @return HasMany
     */
    public function usecases(): HasMany
    {
        return $this->hasMany(Usecase::class);
    }

    /**
     * Lists Evaluations
     * @return HasMany
     */
    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return UserRole::from($this->role)->name === $role;
    }

    /**
     * Gets user medal status text
     * @return string
     */
    public function getMedalStatus(): string
    {
        $medalStatus = 'NA';
        foreach (MedalStatus::cases() as $medal) {
            if ($this->rating >= $medal->value) {
                $medalStatus = $medal->name;
            }
            else{
                break;
            }
        }

        return $medalStatus;
    }

    /**
     * Increments user rating
     * @return void
     */
    public function incrementRating()
    {
        $this->increment('rating');
    }

    /**
     * Decrements user rating
     * @return void
     */
    public function decrementRating()
    {
        $this->decrement('rating');
    }

    /**
     * Activates the user
     * @return $this
     */
    public function activate()
    {
        $this->active = true;
        return $this;
    }

    /**
     * Bans the user
     * @return $this
     */
    public function ban()
    {
        $this->active = false;
        return $this;
    }
}
