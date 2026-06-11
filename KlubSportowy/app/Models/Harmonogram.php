<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harmonogram extends Model
{
    use HasFactory;

    protected $table = 'harmonogram'; // Nazwa tabeli w bazie danych
    protected $primaryKey = 'id'; // Klucz główny
    public $timestamps = false; // Jeśli nie używasz kolumn timestamps

    protected $fillable = [
        'ID', 'DATA_SPOTKANIA', 'STATUS_MECZU', 'ROZGRYWKI_ID', 'DRUZYNA_ID', 'LICZBA_GOLI'

    ];

    // Definiowanie relacji
    public function rozgrywki()
    {
        return $this->belongsTo(Rozgrywki::class, 'rozgrywki_id', 'id');
    }

    public function druzyna()
    {
        return $this->belongsTo(Druzyny::class, 'druzyna_id', 'id');
    }
}
