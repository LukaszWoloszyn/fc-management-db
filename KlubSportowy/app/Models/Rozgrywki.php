<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rozgrywki extends Model
{
    protected $table = 'rozgrywki'; // nazwa tabeli
    protected $primaryKey = 'id'; // klucz główny
    public $timestamps = false;

    protected $fillable = [
        'nazwa',
        'data_rozpoczecia',
        'data_zakonczenia',
    ];
}
