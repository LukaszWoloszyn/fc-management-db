<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class StatystykiController extends Controller
{
    public function index(Request $request)
    {
        $data_meczu = $request->input('data_meczu', null);

        try {
            $statystyki = $this->pobierzStatystykiFiltr($data_meczu);

            $zawodnicy = $this->pobierzWszystkichZawodnikow();
            $zawodnicyMap = [];
            foreach ($zawodnicy as $zawodnik) {
                $zawodnicyMap[$zawodnik['ID']] = $zawodnik['DANE'];
            }

            $harmonogramy = $this->pobierzRozegraneHarmonogramy();
            $harmonogramyMap = [];
            foreach ($harmonogramy as $mecz) {
                $harmonogramyMap[$mecz['ID']] = $mecz['DATA_SPOTKANIA'];
            }

            foreach ($statystyki as &$s) {
                $s['DANE'] = $zawodnicyMap[$s['ZAWODNIK_ID']] ?? 'Nieznany zawodnik';
                $s['DATA_SPOTKANIA'] = isset($harmonogramyMap[$s['MECZ_ID']]) ? date('Y-m-d', strtotime($harmonogramyMap[$s['MECZ_ID']])) : 'Nieznany mecz';
            }

            $harmonogramyDaty = array_unique(array_column($harmonogramy, 'DATA_SPOTKANIA'));

            return view('statystyki.index', [
                'statystyki' => $statystyki,
                'harmonogramyDaty' => $harmonogramyDaty,
                'data_meczu' => $data_meczu
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function create()
    {
        $zawodnicy = $this->pobierzWszystkichZawodnikow();
        $harmonogramy = $this->pobierzWszystkieHarmonogramy();
        $harmonogramy = $this->pobierzRozegraneHarmonogramy();
        foreach ($harmonogramy as &$mecz) {
            $mecz['DATA_SPOTKANIA'] = date('Y-m-d', strtotime($mecz['DATA_SPOTKANIA']));
        }
        return view('statystyki.create', compact('zawodnicy', 'harmonogramy'));
    }

    public function zawodnikNajwiecejGoli()
    {
        try {
            $zawodnicyCursor = DB::getPdo()->prepare('BEGIN :cursor := najlepsi_zawodnicy(); END;');
            $zawodnicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $zawodnicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $zawodnicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $zawodnicy[] = $row;
            }
            oci_free_statement($cursor);

            return view('statystyki.najwiecej_goli', ['zawodnicy' => $zawodnicy]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function zawodnikNajwiecejAsyst()
    {
        try {
            $zawodnicyCursor = DB::getPdo()->prepare('BEGIN :cursor := najwiecej_asyst(); END;');
            $zawodnicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $zawodnicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $zawodnicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $zawodnicy[] = $row;
            }
            oci_free_statement($cursor);

            return view('statystyki.najwiecej_asyst', ['zawodnicy' => $zawodnicy]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzWszystkieStatystyki(Request $request)
    {
        $data_meczu = $request->input('data_meczu', null);

        try {
            $statystyki = $this->pobierzStatystykiFiltr($data_meczu);

            $zawodnicy = $this->pobierzWszystkichZawodnikow();
            $zawodnicyMap = [];
            foreach ($zawodnicy as $zawodnik) {
                $zawodnicyMap[$zawodnik['ID']] = $zawodnik['DANE'];
            }

            $harmonogramy = $this->pobierzRozegraneHarmonogramy();
            $harmonogramyMap = [];
            foreach ($harmonogramy as $mecz) {
                $harmonogramyMap[$mecz['ID']] = $mecz['DATA_SPOTKANIA'];
            }

            foreach ($statystyki as &$s) {
                $s['DANE'] = $zawodnicyMap[$s['ZAWODNIK_ID']] ?? 'Nieznany zawodnik';
                $s['DATA_SPOTKANIA'] = isset($harmonogramyMap[$s['MECZ_ID']]) ? date('Y-m-d', strtotime($harmonogramyMap[$s['MECZ_ID']])) : 'Nieznany mecz';
            }

            $harmonogramyDaty = array_unique(array_column($harmonogramy, 'DATA_SPOTKANIA'));

            return view('statystyki.statystyki', [
                'statystyki' => $statystyki,
                'harmonogramyDaty' => $harmonogramyDaty,
                'data_meczu' => $data_meczu
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function pobierzWszystkichZawodnikow($druzyna_id = null)
    {
        try {
            $zawodnicyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkich_zawodnikow(:cursor, :druzyna_id); END;');
            $zawodnicyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            if (is_null($druzyna_id)) {
                $zawodnicyCursor->bindValue(':druzyna_id', null, \PDO::PARAM_NULL);
            } else {
                $zawodnicyCursor->bindValue(':druzyna_id', $druzyna_id, \PDO::PARAM_INT);
            }
            $zawodnicyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $zawodnicy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $zawodnicy[] = $row;
            }
            oci_free_statement($cursor);
            return $zawodnicy;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzWszystkieHarmonogramy()
    {
        try {
            $harmonogramyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_harmonogramy(:cursor); END;');
            $harmonogramyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $harmonogramyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $harmonogramy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $harmonogramy[] = $row;
            }
            oci_free_statement($cursor);
            return $harmonogramy;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'bramki' => 'required|integer',
            'asysty' => 'required|integer',
            'zolte_kartki' => 'required|integer',
            'czerwone_kartki' => 'required|integer',
            'zawodnik_id' => 'required|integer',
            'mecz_id' => 'required|integer',
        ]);

        $bramki = $request->input('bramki');
        $asysty = $request->input('asysty');
        $zolte_kartki = $request->input('zolte_kartki');
        $czerwone_kartki = $request->input('czerwone_kartki');
        $zawodnik_id = $request->input('zawodnik_id');
        $mecz_id = $request->input('mecz_id');

        DB::statement('BEGIN dodaj_statystyki(:p_zawodnik_id, :p_mecz_id, :p_bramki, :p_asysty, :p_zolte_kartki, :p_czerwone_kartki); END;', [
            'p_zawodnik_id' => $zawodnik_id,
            'p_mecz_id' => $mecz_id,
            'p_bramki' => $bramki,
            'p_asysty' => $asysty,
            'p_zolte_kartki' => $zolte_kartki,
            'p_czerwone_kartki' => $czerwone_kartki,
        ]);

        return redirect()->route('statystyki.index')->with('success', 'Statystyki zostały dodane pomyślnie.');
    }

    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_statystyki(:id, :zawodnik_id, :mecz_id, :bramki, :asysty, :zolte_kartki, :czerwone_kartki); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $zawodnik_id = 0;
            $mecz_id = 0;
            $bramki = 0;
            $asysty = 0;
            $zolte_kartki = 0;
            $czerwone_kartki = 0;

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':zawodnik_id', $zawodnik_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':mecz_id', $mecz_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':bramki', $bramki, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':asysty', $asysty, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':zolte_kartki', $zolte_kartki, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':czerwone_kartki', $czerwone_kartki, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();

            $zawodnicy = $this->pobierzWszystkichZawodnikow();
            $harmonogramy = $this->pobierzRozegraneHarmonogramy();
            foreach ($harmonogramy as &$mecz) {
                $mecz['DATA_SPOTKANIA'] = date('Y-m-d', strtotime($mecz['DATA_SPOTKANIA']));
            }
            return view('statystyki.edit', [
                'id' => $id,
                'zawodnik_id' => $zawodnik_id,
                'mecz_id' => $mecz_id,
                'bramki' => $bramki,
                'asysty' => $asysty,
                'zolte_kartki' => $zolte_kartki,
                'czerwone_kartki' => $czerwone_kartki,
                'zawodnicy' => $zawodnicy,
                'harmonogramy' => $harmonogramy
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzRozegraneHarmonogramy()
    {
        try {
            $harmonogramyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_harmonogramy(:cursor); END;');
            $harmonogramyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $harmonogramyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $harmonogramy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                if ($row['STATUS_MECZU'] == 'Rozegrany') {
                    $row['DATA_SPOTKANIA'] = date('Y-m-d', strtotime($row['DATA_SPOTKANIA']));
                    $harmonogramy[] = $row;
                }
            }
            oci_free_statement($cursor);
            return $harmonogramy;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzStatystykiFiltr($data_meczu = null)
    {
        try {
            $statystykiCursor = DB::getPdo()->prepare('BEGIN :cursor := pobierz_statystyki_filtr(:data_meczu); END;');
            $statystykiCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $statystykiCursor->bindParam(':data_meczu', $data_meczu, \PDO::PARAM_STR);

            $statystykiCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $statystyki = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $statystyki[] = $row;
            }
            oci_free_statement($cursor);

            return $statystyki;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bramki' => 'required|integer',
            'asysty' => 'required|integer',
            'zolte_kartki' => 'required|integer',
            'czerwone_kartki' => 'required|integer',
            'zawodnik_id' => 'required|integer',
            'mecz_id' => 'required|integer',
        ]);

        $nowe_bramki = $request->input('bramki');
        $nowe_asysty = $request->input('asysty');
        $nowe_zolte_kartki = $request->input('zolte_kartki');
        $nowe_czerwone_kartki = $request->input('czerwone_kartki');
        $nowy_zawodnik_id = $request->input('zawodnik_id');
        $nowy_mecz_id = $request->input('mecz_id');

        DB::statement('BEGIN aktualizuj_statystyki(:p_id, :p_nowy_zawodnik_id, :p_nowy_mecz_id, :p_nowe_bramki, :p_nowe_asysty, :p_nowe_zolte_kartki, :p_nowe_czerwone_kartki); END;', [
            'p_id' => $id,
            'p_nowy_zawodnik_id' => $nowy_zawodnik_id,
            'p_nowy_mecz_id' => $nowy_mecz_id,
            'p_nowe_bramki' => $nowe_bramki,
            'p_nowe_asysty' => $nowe_asysty,
            'p_nowe_zolte_kartki' => $nowe_zolte_kartki,
            'p_nowe_czerwone_kartki' => $nowe_czerwone_kartki,
        ]);

        return redirect()->route('statystyki.index')->with('success', 'Statystyki zostały zaktualizowane pomyślnie.');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_statystyki(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('statystyki.index')->with('success', 'Statystyki zostały usunięte pomyślnie.');
    }
}
