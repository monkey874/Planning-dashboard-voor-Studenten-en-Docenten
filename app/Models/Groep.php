<?php

namespace App\Models;

use Database\Factories\GroepFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['naam', 'opleiding_id'])]
class Groep extends Model
{
    /** @use HasFactory<GroepFactory> */
    use HasFactory;

    protected $table = 'groepen';

    /** @return BelongsTo<Opleiding, $this> */
    public function opleiding(): BelongsTo
    {
        return $this->belongsTo(Opleiding::class);
    }

    /** @return BelongsToMany<Activiteit, $this> */
    public function activiteiten(): BelongsToMany
    {
        return $this->belongsToMany(Activiteit::class, 'activiteit_groep');
    }
}
