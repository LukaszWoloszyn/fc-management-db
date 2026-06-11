<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pracownicy extends Model
{
    protected $table = 'pracownicy'; // nazwa tabeli
    protected $primaryKey = 'id'; // klucz główny
    public $timestamps = false;

    protected $fillable = [
        'dane',
        'stanowisko',
        'druzyna_id',
    ];

    // Definiowanie relacji
    public function druzyna()
    {
        return $this->belongsTo(Druzyny::class, 'druzyna_id', 'id');
    }
}
