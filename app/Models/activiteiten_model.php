<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activiteiten_model extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected static function newFactory()
    {
        return \Database\Factories\activiteitenFactory::new();
    }

    protected $table = 'activiteiten';

    protected $fillable = [
        'titel',
        'omschrijving',
        'datum',
        'starttijd',
        'eindtijd',
        'type',
        'aangemaakt_door'
    ];
}
