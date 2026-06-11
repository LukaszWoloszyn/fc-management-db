<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statystyki extends Model
{
    protected $table = 'statystyki'; // nazwa tabeli
    protected $primaryKey = 'id'; // klucz główny
    public $timestamps = false;

    protected $fillable = [
        'bramki',
        'asysty',
        'zolte_kartki',
        'czerwone_kartki',
        'zawodnik_id',
        'mecz_id',
    ];

    // Definiowanie relacji
    public function zawodnik()
    {
        return $this->belongsTo(Zawodnicy::class, 'zawodnik_id', 'id');
    }

    public function mecz()
    {
        return $this->belongsTo(Harmonogram::class, 'mecz_id', 'id');
    }
}
