<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class PracownicyController extends Controller
{

    public function index()
    {
        try {
            $pracownicyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkich_pracownikow(:cursor); END;');
            $pracownicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $pracownicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $pracownicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $pracownicy[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();
            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($pracownicy as &$pracownik) {
                $pracownik['KATEGORIA'] = $druzynyMap[$pracownik['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }

            return view('pracownicy.index', ['pracownicy' => $pracownicy]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzWszystkichPracownikow()
    {
        try {
            $pracownicyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkich_pracownikow(:cursor); END;');
            $pracownicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $pracownicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $pracownicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $pracownicy[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();
            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($pracownicy as &$pracownik) {
                $pracownik['KATEGORIA'] = $druzynyMap[$pracownik['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }
            return view('pracownicy.pracownicy', ['pracownicy' => $pracownicy]);
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


    public function create()
    {
        $druzyny = $this->pobierzWszystkieDruzyny();
        return view('pracownicy.create', ['druzyny' => $druzyny]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'dane' => 'required|string|max:100',
            'stanowisko' => 'required|string|max:100',
            'druzyna_id' => 'required|integer',
        ]);

        $dane = $request->input('dane');
        $stanowisko = $request->input('stanowisko');
        $druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN dodaj_pracownika(:p_dane, :p_stanowisko, :p_druzyna_id); END;', [
            'p_dane' => $dane,
            'p_stanowisko' => $stanowisko,
            'p_druzyna_id' => $druzyna_id,
        ]);

        return redirect()->route('pracownicy.index')->with('success', 'Pracownik został dodany pomyślnie.');
    }


    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_pracownika(:id, :dane, :stanowisko, :druzyna_id); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $dane = '';
            $stanowisko = '';
            $druzyna_id = 0;

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':dane', $dane, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':stanowisko', $stanowisko, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();

            $druzyny = $this->pobierzWszystkieDruzyny();

            return view('pracownicy.edit', [
                'id' => $id,
                'dane' => $dane,
                'stanowisko' => $stanowisko,
                'druzyna_id' => $druzyna_id,
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
            'stanowisko' => 'required|string|max:100',
            'druzyna_id' => 'required|integer',
        ]);

        $nowe_dane = $request->input('dane');
        $nowe_stanowisko = $request->input('stanowisko');
        $nowe_druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN aktualizuj_pracownika(:p_id, :p_nowe_dane, :p_nowe_stanowisko, :p_nowe_druzyna_id); END;', [
            'p_id' => $id,
            'p_nowe_dane' => $nowe_dane,
            'p_nowe_stanowisko' => $nowe_stanowisko,
            'p_nowe_druzyna_id' => $nowe_druzyna_id,
        ]);

        return redirect()->route('pracownicy.index')->with('success', 'Pracownik został zaktualizowany pomyślnie.');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_pracownika(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('pracownicy.index')->with('success', 'Pracownik został usunięty pomyślnie.');
    }
}
