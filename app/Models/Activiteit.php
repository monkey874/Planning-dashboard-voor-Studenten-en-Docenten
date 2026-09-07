<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


#[Fillable(['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type', 'aangemaakt_door'])]
class Activiteit extends Model
{
    use HasFactory;
    protected $table = 'activiteiten';

    protected function casts(): array
    {
        return [
            'datum' => 'date',
        ];
    }

    public function aangemaaktDoor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aangemaakt_door');
    }

    public function groepen(): BelongsToMany
    {
        return $this->belongsToMany(Groep::class, 'activiteit_groep');
    }
}
