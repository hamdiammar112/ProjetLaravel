<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Abonnement;

class Plan extends Model
{
    use HasFactory;


    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }
}
