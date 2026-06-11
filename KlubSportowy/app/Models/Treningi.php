<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treningi extends Model
{
    protected $table = 'treningi'; // nazwa tabeli
    protected $primaryKey = 'id'; // klucz główny
    public $timestamps = false;

    protected $fillable = [
        'data',
        'lokalizacja',
        'druzyna_id',
    ];

    // Definiowanie relacji
    public function druzyna()
    {
        return $this->belongsTo(Druzyny::class, 'druzyna_id', 'id');
    }
}
