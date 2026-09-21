<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['activiteit_id', 'groep_id'])]
class koppel extends Model
{
    use HasFactory;

    protected $table = 'activiteit_groep';

    public function activiteit_id(): BelongsTo
    {
        return $this->belongsTo(Activiteit::class);
    }

    /** @return BelongsToMany<Activiteit, Groep> */
    public function groep_id(): BelongsTo
    {
        return $this->belongsTo(Groep::class);
    }
}
