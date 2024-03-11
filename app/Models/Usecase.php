<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Usecase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'source', 'origin', 'standout_characteristics',
        'limitations', 'link', 'rri', 'acknowledgement', 'status', 'user_id', 'featured'
    ];

    public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class);
    }

    public function user_inputs(): BelongsToMany
    {
        return $this->belongsToMany(UserInput::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dimensions(): \Illuminate\Support\Collection
    {
        $dimensions = collect();

        foreach ($this->user_inputs as $user_input) {
            $dimensions->put($user_input->dimension->id, $user_input->dimension);
        }

        return $dimensions->unique();
    }

    public function approve()
    {
        $this->status = \App\Enum\UsecaseStatus::Approved;
        return $this;
    }

    public function reject()
    {
        $this->status = \App\Enum\UsecaseStatus::Rejected;
        $this->featured = false;
        return $this;
    }

    public function feature()
    {
        $this->featured = true;
        return $this;
    }

    public function unfeature()
    {
        $this->featured = false;
        return $this;
    }
}
