<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Issue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['usecase_id', 'email', 'message', 'status'];

    /**
     * @return BelongsTo
     */
    public function usecase(): BelongsTo
    {
        return $this->belongsTo(Usecase::class);
    }

    /**
     * Set status to \App\Enum\IssueStatus::Resolved
     * @return $this
     */
    public function resolve()
    {
        $this->status = \App\Enum\IssueStatus::Resolved;
        return $this;
    }
}
