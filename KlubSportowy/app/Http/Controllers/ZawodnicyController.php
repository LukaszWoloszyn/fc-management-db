<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class ZawodnicyController extends Controller
{

    public function index(Request $request)
    {
        $druzyna_id = $request->input('druzyna_id', null);

        try {
            $zawodnicyCursor = DB::getPdo()->prepare('BEGIN :cursor := pobierz_zawodnikow_filtrowanych(:druzyna_id); END;');
            $zawodnicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);

            if (is_null($druzyna_id)) {
                $zawodnicyCursor->bindValue(':druzyna_id', null, \PDO::PARAM_NULL);
            } else {
                $zawodnicyCursor->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT);
            }

            $zawodnicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $zawodnicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $zawodnicy[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();
            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($zawodnicy as &$zawodnik) {
                $zawodnik['NAZWA_DRUZYNY'] = $druzynyMap[$zawodnik['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }

            return view('zawodnicy.index', [
                'zawodnicy' => $zawodnicy,
                'druzyny' => $druzyny,
                'druzyna_id' => $druzyna_id
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }




    public function pobierzWszystkieDruzyny()
    {
        try {
            $druzynyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_druzyny(:cursor); END;');
            $druzynyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $druzynyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $druzyny = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $druzyny[] = $row;
            }
            oci_free_statement($cursor);
            return $druzyny;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzWszystkichZawodnikow(Request $request)
    {
        $druzyna_id = $request->input('druzyna_id', null);

        try {
            $zawodnicyCursor = DB::getPdo()->prepare('BEGIN :cursor := pobierz_zawodnikow_filtrowanych(:druzyna_id); END;');
            $zawodnicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            if (is_null($druzyna_id)) {
                $zawodnicyCursor->bindValue(':druzyna_id', null, \PDO::PARAM_NULL);
            } else {
                $zawodnicyCursor->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT);
            }

            $zawodnicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $zawodnicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $zawodnicy[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();
            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($zawodnicy as &$zawodnik) {
                $zawodnik['NAZWA_DRUZYNY'] = $druzynyMap[$zawodnik['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }

            return view('zawodnicy.zawodnicy', [
                'zawodnicy' => $zawodnicy,
                'druzyny' => $druzyny,
                'druzyna_id' => $druzyna_id
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzZawodnikowZDruzyny($druzyna_id)
    {
        try {
            $zawodnicyCursor = DB::getPdo()->prepare('BEGIN zarzadzanie_zawodnikami.pobierz_zawodnikow_z_druzyny(:druzyna_id, :cursor); END;');
            $zawodnicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $zawodnicyCursor->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT);
            $zawodnicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $zawodnicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $zawodnicy[] = $row;
            }
            oci_free_statement($cursor);

            return view('zawodnicy.z_druzyny', ['zawodnicy' => $zawodnicy]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }



    public function create()
    {
        try {
            $druzynyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_druzyny(:cursor); END;');
            $druzynyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $druzynyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $druzyny = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $druzyny[] = $row;
            }
            oci_free_statement($cursor);
            return view('zawodnicy.create', ['druzyny' => $druzyny]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return view('zawodnicy.create', compact('druzyny'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dane' => 'required|string|max:100',
            'wiek' => 'required|integer',
            'pozycja' => 'required|string|max:50',
            'druzyna_id' => 'required|integer',
        ]);

        $dane = $request->input('dane');
        $wiek = $request->input('wiek');
        $pozycja = $request->input('pozycja');
        $druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN dodaj_zawodnika(:p_dane, :p_wiek, :p_pozycja, :p_druzyna_id); END;', [
            'p_dane' => $dane,
            'p_wiek' => $wiek,
            'p_pozycja' => $pozycja,
            'p_druzyna_id' => $druzyna_id,
        ]);

        return redirect()->route('zawodnicy.index')->with('success', 'Zawodnik został dodany pomyślnie.');
    }

    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_zawodnika(:id, :dane, :wiek, :pozycja, :druzyna_id); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $dane = '';
            $wiek = 0;
            $pozycja = '';
            $druzyna_id = 0;

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':dane', $dane, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':wiek', $wiek, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':pozycja', $pozycja, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();

            $zawodnik = [
                'id' => $id,
                'dane' => $dane,
                'wiek' => $wiek,
                'pozycja' => $pozycja,
                'druzyna_id' => $druzyna_id
            ];

            $druzyny = $this->pobierzWszystkieDruzyny();

            return view('zawodnicy.edit', [
                'zawodnik' => $zawodnik,
                'druzyny' => $druzyny
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'dane' => 'required|string|max:100',
            'wiek' => 'required|integer',
            'pozycja' => 'required|string|max:50',
            'druzyna_id' => 'required|integer',
        ]);

        $nowe_dane = $request->input('dane');
        $nowy_wiek = $request->input('wiek');
        $nowa_pozycja = $request->input('pozycja');
        $nowa_druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN aktualizuj_zawodnika(:p_id, :p_nowe_dane, :p_nowy_wiek, :p_nowa_pozycja, :p_nowa_druzyna_id); END;', [
            'p_id' => $id,
            'p_nowe_dane' => $nowe_dane,
            'p_nowy_wiek' => $nowy_wiek,
            'p_nowa_pozycja' => $nowa_pozycja,
            'p_nowa_druzyna_id' => $nowa_druzyna_id,
        ]);

        return redirect()->route('zawodnicy.index')->with('success', 'Zawodnik został zaktualizowany pomyślnie.');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_zawodnika(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('zawodnicy.index')->with('success', 'Zawodnik został usunięty pomyślnie.');
    }
}


