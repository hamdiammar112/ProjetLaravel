<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Abonnement extends Model
{
    use HasFactory;

    protected $casts = [
        'expiration' => 'date'
    ];


    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
