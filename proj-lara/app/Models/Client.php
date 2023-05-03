<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Coach;

use App\Models\Abonnement;

class Client extends Model
{
    use HasFactory;


    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }
}
