<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'message', 'status'];

    /**
     * Set status to \App\Enum\MessageStatus::Resolved
     * @return $this
     */
    public function resolve()
    {
        $this->status = \App\Enum\MessageStatus::Resolved;
        return $this;
    }
}
