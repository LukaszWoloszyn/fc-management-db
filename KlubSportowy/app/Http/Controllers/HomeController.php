<?php

namespace App\Http\Controllers;

use App\Models\Zawodnicy;


class HomeController extends Controller
{
    public function home() {
        $zawodnicy = Zawodnicy::take(4)->get();
        return view('home', ['zawodnicy' => $zawodnicy]);
    }

}
