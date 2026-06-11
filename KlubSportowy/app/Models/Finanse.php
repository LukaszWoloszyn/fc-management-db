<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finanse extends Model
{
    protected $table = 'finanse'; // nazwa tabeli
    protected $primaryKey = 'id'; // klucz główny
    public $timestamps = false;

    protected $fillable = [
        'kwota',
        'opis',
        'sponsor_id',
    ];

    // Definiowanie relacji
    public function sponsor()
    {
        return $this->belongsTo(Sponsorzy::class, 'sponsor_id', 'id');
    }
}
