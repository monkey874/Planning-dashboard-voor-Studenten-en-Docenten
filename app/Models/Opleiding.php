<?php

namespace App\Models;

use Database\Factories\OpleidingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['naam', 'code'])]
class Opleiding extends Model
{
    /** @use HasFactory<OpleidingFactory> */
    use HasFactory;

    protected $table = 'opleidingen';

    /** @return HasMany<Groep, Opleiding> */
    public function groepen(): HasMany
    {
        return $this->hasMany(Groep::class);
    }
}
