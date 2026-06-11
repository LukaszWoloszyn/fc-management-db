<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorzy extends Model
{
    protected $table = 'sponsorzy'; // nazwa tabeli
    protected $primaryKey = 'id'; // klucz główny
    public $timestamps = false;

    protected $fillable = [
        'nazwa',
        'kwota_sponsorowania',
        'druzyna_id',
    ];

    // Definiowanie relacji
    public function druzyna()
    {
        return $this->belongsTo(Druzyny::class, 'druzyna_id', 'id');
    }
}
