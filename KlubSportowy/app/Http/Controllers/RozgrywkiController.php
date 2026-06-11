<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class RozgrywkiController extends Controller
{

    public function index()
    {
        try {
            $rozgrywkiCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_rozgrywki(:cursor); END;');
            $rozgrywkiCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $rozgrywkiCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $rozgrywki = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $row['DATA_ROZPOCZECIA'] = date('Y-m-d', strtotime($row['DATA_ROZPOCZECIA']));
                $row['DATA_ZAKONCZENIA'] = date('Y-m-d', strtotime($row['DATA_ZAKONCZENIA']));

                $rozgrywki[] = $row;
            }
            oci_free_statement($cursor);
            return view('rozgrywki.index', ['rozgrywki' => $rozgrywki]);
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
                $row['DATA_ROZPOCZECIA'] = date('Y-m-d', strtotime($row['DATA_ROZPOCZECIA']));
                $row['DATA_ZAKONCZENIA'] = date('Y-m-d', strtotime($row['DATA_ZAKONCZENIA']));
                $rozgrywki[] = $row;
            }
            oci_free_statement($cursor);
            return view('rozgrywki.rozgrywki', ['rozgrywki' => $rozgrywki]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function create()
    {
        return view('rozgrywki.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nazwa' => 'required|string|max:100',
            'data_rozpoczecia' => 'required|date',
            'data_zakonczenia' => 'required|date|after_or_equal:data_rozpoczecia',
        ], [
            'data_zakonczenia.after_or_equal' => 'Data zakończenia musi być równa lub późniejsza niż data rozpoczęcia.',
        ]);

        $nazwa = $request->input('nazwa');
        $data_rozpoczecia = $request->input('data_rozpoczecia');
        $data_zakonczenia = $request->input('data_zakonczenia');

        DB::statement('BEGIN dodaj_rozgrywki(:p_nazwa, :p_data_rozpoczecia, :p_data_zakonczenia); END;', [
            'p_nazwa' => $nazwa,
            'p_data_rozpoczecia' => $data_rozpoczecia,
            'p_data_zakonczenia' => $data_zakonczenia,
        ]);

        return redirect()->route('rozgrywki.index')->with('success', 'Rozgrywki zostały dodane pomyślnie.');
    }


    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_rozgrywki(:id, :nazwa, :data_rozpoczecia, :data_zakonczenia); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $nazwa = '';
            $data_rozpoczecia = '';
            $data_zakonczenia = '';

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':nazwa', $nazwa, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':data_rozpoczecia', $data_rozpoczecia, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':data_zakonczenia', $data_zakonczenia, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->execute();

            return view('rozgrywki.edit', [
                'id' => $id,
                'nazwa' => $nazwa,
                'data_rozpoczecia' => $data_rozpoczecia,
                'data_zakonczenia' => $data_zakonczenia
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nazwa' => 'required|string|max:100',
            'data_rozpoczecia' => 'required|date',
            'data_zakonczenia' => 'required|date|after_or_equal:data_rozpoczecia',
        ], [
            'data_zakonczenia.after_or_equal' => 'Data zakończenia musi być równa lub późniejsza niż data rozpoczęcia.',
        ]);

        $nowa_nazwa = $request->input('nazwa');
        $nowa_data_rozpoczecia = $request->input('data_rozpoczecia');
        $nowa_data_zakonczenia = $request->input('data_zakonczenia');

        DB::statement('BEGIN aktualizuj_rozgrywki(:p_id, :p_nowa_nazwa, :p_nowa_data_rozpoczecia, :p_nowa_data_zakonczenia); END;', [
            'p_id' => $id,
            'p_nowa_nazwa' => $nowa_nazwa,
            'p_nowa_data_rozpoczecia' => $nowa_data_rozpoczecia,
            'p_nowa_data_zakonczenia' => $nowa_data_zakonczenia,
        ]);

        return redirect()->route('rozgrywki.index')->with('success', 'Rozgrywki zostały zaktualizowane pomyślnie.');
    }


    public function destroy($id)
    {
        DB::statement('BEGIN usun_rozgrywki(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('rozgrywki.index')->with('success', 'Rozgrywki zostały usunięte pomyślnie.');
    }
}
