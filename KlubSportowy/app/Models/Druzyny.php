<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Druzyny extends Model
{
    protected $table = 'druzyny'; // Małymi literami i bez nietypowych znaków
    protected $primaryKey = 'id'; // Standardowa nazwa klucza głównego
    public $timestamps = false;

    protected $fillable = [
        'nazwa_druzyny',
        'kategoria',
    ];
}
