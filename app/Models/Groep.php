<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['naam', 'opleiding_id'])]
class Groep extends Model
{
    use HasFactory;
    protected $table = 'groepen';

    public function opleiding(): BelongsTo
    {
        return $this->belongsTo(Opleiding::class);
    }

    public function activiteiten(): BelongsToMany
    {
        return $this->belongsToMany(Activiteit::class, 'activiteit_groep');
    }
}
