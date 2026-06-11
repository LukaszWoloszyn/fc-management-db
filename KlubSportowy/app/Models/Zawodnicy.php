<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zawodnicy extends Model
{
    protected $table = 'zawodnicy'; // nazwa tabeli
    protected $primaryKey = 'id'; // klucz główny
    public $timestamps = false;

    protected $fillable = [
        'dane',
        'wiek',
        'pozycja',
        'druzyna_id',
    ];

    // Definiowanie relacji
    public function druzyna()
    {
        return $this->belongsTo(Druzyny::class, 'druzyna_id', 'id');
    }
}
