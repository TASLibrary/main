<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dimension extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'question', 'description', 'input_type'
    ];

    /**
     * Lists Characteristics
     * @return HasMany
     */
    public function characteristic(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }

    /**
     * Lists UserInputs
     * @return HasMany
     */
    public function user_inputs(): HasMany
    {
        return $this->hasMany(UserInput::class);
    }
}
