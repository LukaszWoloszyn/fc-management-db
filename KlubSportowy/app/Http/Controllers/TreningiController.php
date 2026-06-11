<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class TreningiController extends Controller
{

    public function index()
{
    try {
        $treningiCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_treningi(:cursor); END;');
        $treningiCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
        $treningiCursor->execute();
        oci_execute($cursor, OCI_DEFAULT);
        $treningi = [];
        while ($row = oci_fetch_assoc($cursor)) {
            $row['DATA'] = date('Y-m-d', strtotime($row['DATA']));
            $treningi[] = $row;
        }
        oci_free_statement($cursor);

        $druzyny = $this->pobierzWszystkieDruzyny();

        $druzynyMap = [];
        foreach ($druzyny as $druzyna) {
            $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
        }

        foreach ($treningi as &$t) {
            $t['KATEGORIA'] = $druzynyMap[$t['DRUZYNA_ID']] ?? 'Nieznana drużyna';
        }

        return view('treningi.index', ['treningi' => $treningi]);
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}


    public function pobierzWszystkieTreningi()
    {
        try {
            $treningiCursor = DB::getPdo()->prepare('BEGIN pobierz_wszystkie_treningi(:cursor); END;');
            $treningiCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);
            $treningiCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);
            $treningi = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $row['DATA'] = date('Y-m-d', strtotime($row['DATA']));
                $treningi[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();

        $druzynyMap = [];
        foreach ($druzyny as $druzyna) {
            $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
        }

        foreach ($treningi as &$t) {
            $t['KATEGORIA'] = $druzynyMap[$t['DRUZYNA_ID']] ?? 'Nieznana drużyna';
        }

            return view('treningi.treningi', ['treningi' => $treningi]);
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
            return view('treningi.create', ['druzyny' => $druzyny]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }        return view('treningi.create', compact('druzyny'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'lokalizacja' => 'required|string|max:100',
            'druzyna_id' => 'required|integer',
        ]);

        $data = $request->input('data');
        $lokalizacja = $request->input('lokalizacja');
        $druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN dodaj_trening(:p_data, :p_lokalizacja, :p_druzyna_id); END;', [
            'p_data' => $data,
            'p_lokalizacja' => $lokalizacja,
            'p_druzyna_id' => $druzyna_id,
        ]);

        return redirect()->route('treningi.index')->with('success', 'Trening został dodany pomyślnie.');
    }

    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_trening(:id, :data, :lokalizacja, :druzyna_id); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $data = '';
            $lokalizacja = '';
            $druzyna_id = 0;

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':data', $data, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':lokalizacja', $lokalizacja, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();

            $druzyny = $this->pobierzWszystkieDruzyny();

            return view('treningi.edit', [
                'id' => $id,
                'data' => $data,
                'lokalizacja' => $lokalizacja,
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
            'data' => 'required|date',
            'lokalizacja' => 'required|string|max:100',
            'druzyna_id' => 'required|integer',
        ]);

        $nowa_data = $request->input('data');
        $nowa_lokalizacja = $request->input('lokalizacja');
        $nowa_druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN aktualizuj_trening(:p_id, :p_nowa_data, :p_nowa_lokalizacja, :p_nowa_druzyna_id); END;', [
            'p_id' => $id,
            'p_nowa_data' => $nowa_data,
            'p_nowa_lokalizacja' => $nowa_lokalizacja,
            'p_nowa_druzyna_id' => $nowa_druzyna_id,
        ]);

        return redirect()->route('treningi.index')->with('success', 'Trening został zaktualizowany pomyślnie.');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_trening(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('treningi.index')->with('success', 'Trening został usunięty pomyślnie.');
    }
}
