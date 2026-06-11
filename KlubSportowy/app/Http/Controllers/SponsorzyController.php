<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class SponsorzyController extends Controller
{

    public function index(Request $request)
    {
        $druzyna_id = $request->input('druzyna_id', null);

        try {
            $sponsorzyCursor = DB::getPdo()->prepare('BEGIN :cursor := pobierz_sponsorow_filtr(:druzyna_id); END;');
            $sponsorzyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);

            if (is_null($druzyna_id)) {
                $sponsorzyCursor->bindValue(':druzyna_id', null, \PDO::PARAM_NULL);
            } else {
                $sponsorzyCursor->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT);
            }

            $sponsorzyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $sponsorzy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $sponsorzy[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();
            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($sponsorzy as &$sponsor) {
                $sponsor['NAZWA_DRUZYNY'] = $druzynyMap[$sponsor['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }

            return view('sponsorzy.index', [
                'sponsorzy' => $sponsorzy,
                'druzyny' => $druzyny,
                'druzyna_id' => $druzyna_id
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function pobierzWszystkichSponsorow(Request $request)
    {
        $druzyna_id = $request->input('druzyna_id', null);

        try {
            $sponsorzyCursor = DB::getPdo()->prepare('BEGIN :cursor := pobierz_sponsorow_filtr(:druzyna_id); END;');
            $sponsorzyCursor->bindParam(':cursor', $cursor, \PDO::PARAM_STMT);

            if (is_null($druzyna_id)) {
                $sponsorzyCursor->bindValue(':druzyna_id', null, \PDO::PARAM_NULL);
            } else {
                $sponsorzyCursor->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT);
            }

            $sponsorzyCursor->execute();
            oci_execute($cursor, OCI_DEFAULT);

            $sponsorzy = [];
            while ($row = oci_fetch_assoc($cursor)) {
                $sponsorzy[] = $row;
            }
            oci_free_statement($cursor);

            $druzyny = $this->pobierzWszystkieDruzyny();
            $druzynyMap = [];
            foreach ($druzyny as $druzyna) {
                $druzynyMap[$druzyna['ID']] = $druzyna['KATEGORIA'];
            }

            foreach ($sponsorzy as &$sponsor) {
                $sponsor['NAZWA_DRUZYNY'] = $druzynyMap[$sponsor['DRUZYNA_ID']] ?? 'Nieznana drużyna';
            }

            return view('sponsorzy.sponsorzy', [
                'sponsorzy' => $sponsorzy,
                'druzyny' => $druzyny,
                'druzyna_id' => $druzyna_id
            ]);
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
            return view('sponsorzy.create', ['druzyny' => $druzyny]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }        return view('sponsorzy.create', compact('druzyny'));
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

    public function store(Request $request)
    {
        $request->validate([
            'nazwa' => 'required|string|max:100',
            'kwota_sponsorowania' => 'required|numeric',
            'druzyna_id' => 'required|integer',
        ]);

        $nazwa = $request->input('nazwa');
        $kwota_sponsorowania = $request->input('kwota_sponsorowania');
        $druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN dodaj_sponsora(:p_nazwa, :p_kwota_sponsorowania, :p_druzyna_id); END;', [
            'p_nazwa' => $nazwa,
            'p_kwota_sponsorowania' => $kwota_sponsorowania,
            'p_druzyna_id' => $druzyna_id,
        ]);

        return redirect()->route('sponsorzy.index')->with('success', 'Sponsor został dodany pomyślnie.');
    }


    public function edit($id)
    {
        try {
            $sql = 'BEGIN pobierz_sponsora(:id, :nazwa, :kwota_sponsorowania, :druzyna_id); END;';
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare($sql);
            $nazwa = '';
            $kwota_sponsorowania = 0;
            $druzyna_id = 0;

            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':nazwa', $nazwa, \PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->bindParam(':kwota_sponsorowania', $kwota_sponsorowania, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->bindParam(':druzyna_id', $druzyna_id, \PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT);
            $stmt->execute();

            $druzyny = $this->pobierzWszystkieDruzyny();

            return view('sponsorzy.edit', [
                'id' => $id,
                'nazwa' => $nazwa,
                'kwota_sponsorowania' => $kwota_sponsorowania,
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
            'nazwa' => 'required|string|max:100',
            'kwota_sponsorowania' => 'required|numeric',
            'druzyna_id' => 'required|integer',
        ]);

        $nowa_nazwa = $request->input('nazwa');
        $nowa_kwota_sponsorowania = $request->input('kwota_sponsorowania');
        $nowa_druzyna_id = $request->input('druzyna_id');

        DB::statement('BEGIN aktualizuj_sponsora(:p_id, :p_nowa_nazwa, :p_nowa_kwota_sponsorowania, :p_nowa_druzyna_id); END;', [
            'p_id' => $id,
            'p_nowa_nazwa' => $nowa_nazwa,
            'p_nowa_kwota_sponsorowania' => $nowa_kwota_sponsorowania,
            'p_nowa_druzyna_id' => $nowa_druzyna_id,
        ]);

        return redirect()->route('sponsorzy.index')->with('success', 'Sponsor został zaktualizowany pomyślnie.');
    }

    public function destroy($id)
    {
        DB::statement('BEGIN usun_sponsora(:p_id); END;', [
            'p_id' => $id,
        ]);

        return redirect()->route('sponsorzy.index')->with('success', 'Sponsor został usunięty pomyślnie.');
    }
}
