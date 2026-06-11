<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;

class DruzynyController extends Controller
{

    public function index()
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
            return view('druzyny.index', ['druzyny' => $druzyny]);
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
            return view('druzyny.druzyny', ['druzyny' => $druzyny]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function create()
    {
        return view('druzyny.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nazwa_druzyny' => 'required|string|max:100',
            'kategoria' => 'required|string|max:100',
        ]);

        $nazwa_druzyny = $request->input('nazwa_druzyny');
        $kategoria = $request->input('kategoria');

        DB::statement('BEGIN dodaj_druzyne(:nazwa_druzyny, :kategoria); END;', [
            'nazwa_druzyny' => $nazwa_druzyny,
            'kategoria' => $kategoria,
        ]);

        return redirect()->route('druzyny.index')->with('success', 'Drużyna została dodana pomyślnie.');
    }

    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_druzyne(:id_druzyny, :nazwa, :kat); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $nazwa = '';
            $kat = '';

            $stmt->bindParam(':id_druzyny', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':nazwa', $nazwa, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':kat', $kat, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->execute();

            return view('druzyny.edit', ['id' => $id, 'nazwa' => $nazwa, 'kat' => $kat]);
        }  catch (\Exception $e) {
            Log::error('Błąd podczas aktualizacji przewoźnika: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Wystąpił błąd podczas aktualizacji przewoźnika.'])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nazwa_druzyny' => 'required|string|max:100',
                'kategoria' => 'required|string|max:100',
            ]);

            $nowa_nazwa = $request->input('nazwa_druzyny');
            $nowa_kategoria = $request->input('kategoria');

            DB::statement('BEGIN aktualizuj_druzyne(:p_id, :nowa_nazwa, :nowa_kategoria); END;', [
                'p_id' => $id,
                'nowa_nazwa' => $nowa_nazwa,
                'nowa_kategoria' => $nowa_kategoria,
            ]);

            return redirect()->route('druzyny.index')->with('success', 'Drużyna została zaktualizowana pomyślnie.');
        }  catch (\Exception $e) {
            Log::error('Błąd podczas aktualizacji przewoźnika: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Wystąpił błąd podczas aktualizacji przewoźnika.'])->withInput();
        }
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_druzyne(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('druzyny.index')->with('success', 'Drużyna została usunięta pomyślnie.');
    }
}
