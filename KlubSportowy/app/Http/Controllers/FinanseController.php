<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class FinanseController extends Controller
{
    public function index()
    {
        try {
            $finanseCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_finanse(:cursor); END;');
            $finanseCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $finanseCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $finanse = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $finanse[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();

            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($finanse as &$f) {
                $f['NAZWA_DRUZYNY'] = $druzynyMap[$f['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }

            return view('finanse.index', ['finanse' => $finanse]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzWszystkieFinanse()
    {
        try {
            $finanseCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_finanse(:cursor); END;');
            $finanseCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $finanseCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $finanse = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $finanse[] = $row;
            }

            $druzyny = $this->pobierzWszystkieDruzyny();

            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($finanse as &$f) {
                $f['NAZWA_DRUZYNY'] = $druzynyMap[$f['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }
            oci_free_statement($cursor);
            return view('finanse.finanse', ['finanse' => $finanse]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    public function obliczBudzetDruzyn()
    {
        try {
            $druzyny = $this->pobierzWszystkieDruzyny();

            $budzety = [];
            foreach ($druzyny as $druzyna) {
                $budzetCursor = DB::getPdo()->prepare('BEGIN :budzet := oblicz_budzet_druzyny(:druzyna_id); END;');
                $budzetCursor->bindParam(':budzet', $budzet, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
                $budzetCursor->bindParam(':druzyna_id', $druzyna['ID'], \PDO::PARAM_INT);
                $budzetCursor->execute();

                $budzety[] = [
                    'KATEGORIA' => $druzyna['KATEGORIA'],
                    'BUDZET' => $budzet
                ];
            }

            return view('finanse.budzety', ['budzety' => $budzety]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function create()
    {
        $druzyny = $this->pobierzWszystkieDruzyny();
        return view('finanse.create', ['druzyny' => $druzyny]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kwota' => 'required|numeric',
            'opis' => 'required|string|max:200',
            'druzyna_id' => 'required|integer',
        ]);

        $kwota = $request->input('kwota');
        $opis = $request->input('opis');
        $druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN dodaj_finanse(:p_kwota, :p_opis, :p_druzyna_id); END;', [
            'p_kwota' => $kwota,
            'p_opis' => $opis,
            'p_druzyna_id' => $druzyna_id,
        ]);

        return redirect()->route('finanse.index')->with('success', 'Finanse zostały dodane pomyślnie.');
    }

    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_finanse(:id, :kwota, :opis, :druzyna_id); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $kwota = 0;
            $opis = '';
            $druzyna_id = 0;

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':kwota', $kwota, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':opis', $opis, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();

            $druzyny = $this->pobierzWszystkieDruzyny();

            return view('finanse.edit', [
                'id' => $id,
                'kwota' => $kwota,
                'opis' => $opis,
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
            'kwota' => 'required|numeric',
            'opis' => 'required|string|max:200',
            'druzyna_id' => 'required|integer',
        ]);

        $nowa_kwota = $request->input('kwota');
        $nowy_opis = $request->input('opis');
        $druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN aktualizuj_finanse(:p_id, :p_nowa_kwota, :p_nowy_opis, :p_druzyna_id); END;', [
            'p_id' => $id,
            'p_nowa_kwota' => $nowa_kwota,
            'p_nowy_opis' => $nowy_opis,
            'p_druzyna_id' => $druzyna_id,
        ]);

        return redirect()->route('finanse.index')->with('success', 'Finanse zostały zaktualizowane pomyślnie.');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_finanse(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('finanse.index')->with('success', 'Finanse zostały usunięte pomyślnie.');
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
}

