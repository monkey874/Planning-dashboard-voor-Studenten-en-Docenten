<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $titel
 * @property string|null $omschrijving
 * @property \Illuminate\Support\Carbon $datum
 * @property string $starttijd
 * @property string $eindtijd
 * @property string $locatie
 */
#[Fillable(['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type', 'aangemaakt_door'])]
class Activiteit extends Model
{
    /** @use HasFactory<\Database\Factories\ActiviteitFactory> */
    use HasFactory;

    protected $table = 'activiteiten';

    protected function casts(): array
    {
        return [
            'datum' => 'date',
        ];
    }

    /** @return BelongsTo<User, Activiteit> */
    public function aangemaaktDoor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aangemaakt_door');
    }

    /** @return BelongsToMany<Groep, Activiteit> */
    public function groepen(): BelongsToMany
    {
        return $this->belongsToMany(Groep::class, 'activiteit_groep');
    }
}
