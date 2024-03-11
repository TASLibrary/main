<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Evaluation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usage_likelihood_rating', 'usage_likelihood_reason', 'positive_points', 'negative_points', 'user_id', 'usecase_id', 'status'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function usecase(): BelongsTo
    {
        return $this->belongsTo(Usecase::class);
    }

    /**
     * Set status to \App\Enum\EvaluationStatus::Approved
     * @return $this
     */
    public function approve()
    {
        $this->status = \App\Enum\EvaluationStatus::Approved->value;
        return $this;
    }

    /**
     * Set status to \App\Enum\EvaluationStatus::Approved
     * @return $this
     */
    public function reject()
    {
        $this->status = \App\Enum\EvaluationStatus::Rejected->value;
        return $this;
    }
}
