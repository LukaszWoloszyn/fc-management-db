<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;

class HarmonogramController extends Controller
{

    public function index()
    {
        try {
            $harmonogramyCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_harmonogramy(:cursor); END;');
            $harmonogramyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $harmonogramyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $harmonogramy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $row['DATA_SPOTKANIA'] = date('Y-m-d', strtotime($row['DATA_SPOTKANIA']));
                $harmonogramy[] = $row;
            }
            oci_free_statement($cursor);

            $rozgrywki = $this->pobierzWszystkieRozgrywki();
            $druzyny = $this->pobierzWszystkieDruzyny();

            $rozgrywkiMap = [];
            foreach ($rozgrywki as $rozgrywka) {
                $rozgrywkiMap[$rozgrywka['ID']] = $rozgrywka['NAZWA'];
            }

            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($harmonogramy as &$h) {
                $h['ROZGRYWKI_NAZWA'] = $rozgrywkiMap[$h['ROZGRYWKI_ID']] ?? 'Nieznana rozgrywka';
                $h['DRUZYNA_NAZWA'] = $druzynyMap[$h['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }

            return view('harmonogram.index', ['harmonogramy' => $harmonogramy]);
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
                $row['DATA_SPOTKANIA'] = date('Y-m-d', strtotime($row['DATA_SPOTKANIA']));
                $harmonogramy[] = $row;
            }
            oci_free_statement($cursor);

            $rozgrywki = $this->pobierzWszystkieRozgrywki();
            $druzyny = $this->pobierzWszystkieDruzyny();

            $rozgrywkiMap = [];
            foreach ($rozgrywki as $rozgrywka) {
                $rozgrywkiMap[$rozgrywka['ID']] = $rozgrywka['NAZWA'];
            }

            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($harmonogramy as &$h) {
                $h['ROZGRYWKI_NAZWA'] = $rozgrywkiMap[$h['ROZGRYWKI_ID']] ?? 'Nieznana rozgrywka';
                $h['DRUZYNA_NAZWA'] = $druzynyMap[$h['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }
            return view('harmonogram.harmonogram', ['harmonogramy' => $harmonogramy]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function pobierzWszystkieRozgrywki()
    {
        try {
            $rozgrywkiCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_rozgrywki(:cursor); END;');
            $rozgrywkiCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $rozgrywkiCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $rozgrywki = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $rozgrywki[] = $row;
            }
            oci_free_statement($cursor);
            return $rozgrywki;
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
        $rozgrywki = $this->pobierzWszystkieRozgrywki();
        $druzyny = $this->pobierzWszystkieDruzyny();
        return view('harmonogram.create', ['rozgrywki' => $rozgrywki, 'druzyny' => $druzyny]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'data_spotkania' => 'required|date',
            'status_meczu' => 'nullable|string|max:50',
            'rozgrywki_id' => 'required|integer',
            'druzyna_id' => 'required|integer',
            'liczba_goli' => 'required|integer',
        ]);

        $data_spotkania = $request->input('data_spotkania');
        $status_meczu = (new \DateTime($data_spotkania) < new \DateTime()) ? 'Rozegrany' : 'Nierozegrany';
        $rozgrywki_id = $request->input('rozgrywki_id');
        $druzyna_id = $request->input('druzyna_id');
        $liczba_goli = $request->input('liczba_goli');

        DB::statement('BEGIN dodaj_harmonogram(:p_data_spotkania, :p_status_meczu, :p_rozgrywki_id, :p_druzyna_id, :p_liczba_goli); END;', [
            'p_data_spotkania' => $data_spotkania,
            'p_status_meczu' => $status_meczu,
            'p_rozgrywki_id' => $rozgrywki_id,
            'p_druzyna_id' => $druzyna_id,
            'p_liczba_goli' => $liczba_goli,
        ]);

        return redirect()->route('harmonogram.index')->with('success', 'Harmonogram został dodany pomyślnie.');
    }

    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_harmonogram(:id, :data_spotkania, :status_meczu, :rozgrywki_id, :druzyna_id, :liczba_goli); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $data_spotkania = '';
            $status_meczu = '';
            $rozgrywki_id = 0;
            $druzyna_id = 0;
            $liczba_goli = 0;

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':data_spotkania', $data_spotkania, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':status_meczu', $status_meczu, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':rozgrywki_id', $rozgrywki_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':liczba_goli', $liczba_goli, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();

            $rozgrywki = $this->pobierzWszystkieRozgrywki();
            $druzyny = $this->pobierzWszystkieDruzyny();

            return view('harmonogram.edit', [
                'id' => $id,
                'data_spotkania' => $data_spotkania,
                'status_meczu' => $status_meczu,
                'rozgrywki_id' => $rozgrywki_id,
                'druzyna_id' => $druzyna_id,
                'rozgrywki' => $rozgrywki,
                'druzyny' => $druzyny,
                'liczba_goli' => $liczba_goli
            ]);
        } catch (\Exception $e) {
            Log::error('blad' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'blad'])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'data_spotkania' => 'required|date',
            'status_meczu' => 'nullable|string|max:50',
            'rozgrywki_id' => 'required|integer',
            'druzyna_id' => 'required|integer',
            'liczba_goli' => 'required|integer',
        ]);

        $nowa_data_spotkania = $request->input('data_spotkania');
        $nowy_status_meczu = (new \DateTime($nowa_data_spotkania) < new \DateTime()) ? 'Rozegrany' : 'Nierozegrany';
        $nowa_rozgrywki_id = $request->input('rozgrywki_id');
        $nowa_druzyna_id = $request->input('druzyna_id');
        $nowa_liczba_goli = $request->input('liczba_goli');

        DB::statement('BEGIN aktualizuj_harmonogram(:p_id, :p_nowa_data_spotkania, :p_nowy_status_meczu, :p_nowa_rozgrywki_id, :p_nowa_druzyna_id, :p_nowa_liczba_goli); END;', [
            'p_id' => $id,
            'p_nowa_data_spotkania' => $nowa_data_spotkania,
            'p_nowy_status_meczu' => $nowy_status_meczu,
            'p_nowa_rozgrywki_id' => $nowa_rozgrywki_id,
            'p_nowa_druzyna_id' => $nowa_druzyna_id,
            'p_nowa_liczba_goli' => $nowa_liczba_goli,
        ]);

        return redirect()->route('harmonogram.index')->with('success', 'Harmonogram został zaktualizowany pomyślnie.');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_harmonogram(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('harmonogram.index')->with('success', 'Harmonogram został usunięty pomyślnie.');
    }
}
