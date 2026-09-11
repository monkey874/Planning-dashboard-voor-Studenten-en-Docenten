<?php

namespace App\Models;

use Database\Factories\ActiviteitFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $titel
 * @property string|null $omschrijving
 * @property Carbon $datum
 * @property string $starttijd
 * @property string $eindtijd
 * @property string $locatie
 */
#[Fillable(['titel', 'omschrijving', 'datum', 'starttijd', 'eindtijd', 'locatie', 'type', 'aangemaakt_door'])]
class Activiteit extends Model
{
    /** @use HasFactory<ActiviteitFactory> */
    use HasFactory;

    protected $table = 'activiteiten';

    protected function casts(): array
    {
        return [
            'datum' => 'date',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function aangemaaktDoor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aangemaakt_door');
    }

    /** @return BelongsToMany<Groep, $this> */
    public function groepen(): BelongsToMany
    {
        return $this->belongsToMany(Groep::class, 'activiteit_groep');
    }
}
