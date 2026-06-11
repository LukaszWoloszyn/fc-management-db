
**Praca projektowa bazy danych**

**System zarządzania klubem piłkarskim**


# Wstęp

**Baza danych** obejmuje szczegółowe informacje dotyczące zawodników, drużyn, harmonogramów meczów, statystyk oraz sponsorów, co umożliwia zarządzanie wszystkimi aspektami funkcjonowania klubu sportowego. Filtracja danych pozwala na uzyskanie szczegółowych informacji dotyczących wyników i statystyk sportowych.

W bazie danych znajdują się dokładne informacje o każdym zawodniku, w tym dane osobowe, wiek, pozycja na boisku oraz przynależność do drużyny. Drużyny są opisane z uwzględnieniem kategorii, do których należą, co umożliwia łatwe sortowanie i wyszukiwanie informacji. Harmonogramy zawierają szczegóły dotyczące dat oraz wyników meczów, co pomaga w śledzeniu historii rozgrywek.

Dane dotyczące statystyk są skrupulatnie gromadzone i zawierają informacje o bramkach, asystach oraz karach otrzymanych przez zawodników w trakcie meczów. Informacje te są ściśle powiązane z harmonogramami, co pozwala na dokładne śledzenie wyników i osiągnięć zawodników w poszczególnych spotkaniach.

Sponsorzy są również ważnym elementem bazy danych. Dane sponsorów obejmują nazwę, kwotę sponsorowania oraz przypisaną drużynę. Dzięki temu możliwe jest monitorowanie wsparcia finansowego dla różnych drużyn i planowanie dalszych działań marketingowych.

System zawiera również dwa różne interfejsy użytkownika (GUI). Pierwszy przeznaczony jest dla zwykłych użytkowników, umożliwiający przeglądanie danych między innymi o zawodnikach, drużynach i wynikach meczów. Drugi interfejs jest dedykowany administratorom, oferując zaawansowane funkcje zarządzania danymi, monitorowania wyników oraz generowania raportów.

Integralną częścią systemu jest ranking zawodników według liczby zdobytych bramek. Ranking ten jest dynamicznie aktualizowany na podstawie wyników meczów, co pozwala na bieżąco śledzić najskuteczniejszych zawodników w klubie sportowym.

# Narzędzia i technologie

Aplikacja została stworzona przy użyciu narzędzi:

- **Visual Studio Code** 1.89.1 (<www.code.visualstudio.com>)

Oraz techonolgii:

- **Oracle 19c** (<www.oracle.com>)
- **PHP** (<www.php.net>)
- **Laravel** 11.x (<www.laravel.com>)
- **Bootstrap** ([www.getbootstrap.com](http://www.getbootstrap.com))

# Baza danych

![Obraz zawierający tekst, diagram, zrzut ekranu, numer

Opis wygenerowany automatycznie]

Połączenie z bazą danych:

![Obraz zawierający tekst, zrzut ekranu, numer, Równolegle

Opis wygenerowany automatycznie]

**Username**: DB_klub

**Password**: DB_klub

**Założenia bazy danych**

- **Każdy zawodnik** musi mieć przypisane dane osobowe, wiek, pozycję na boisku oraz drużynę, do której należy.
- **Każdy mecz** w harmonogramie musi być powiązany z drużyną oraz zawierać datę rozegrania i wynik meczu.
- **Każdy sponsor** musi być powiązany z jedną drużyną, którą sponsoruje.
- **Każda statystyka** musi być przypisana do konkretnego zawodnika i meczu, z wyszczególnieniem liczby bramek, asyst oraz kar.
- **Każda drużyna** musi mieć przypisaną kategorię oraz co najmniej jednego zawodnika.

**Ograniczenia bazy danych**

- **Każdy zawodnik** musi mieć unikalne dane osobowe (np. imię, nazwisko).
- **Każdy zawodnik** może być przypisany tylko do jednej drużyny na raz.
- **Pole "Liczba bramek"** w tabeli "Statystyki" musi mieć wartość większą lub równą zero.

## Tabele

**Tabela Zawodnicy: (1)**

- **ID** _(klucz główny) (int) (not null)_ - Unikalny identyfikator zawodnika;
- **Dane** _(varchar) (not null)_ - Dane osobowe zawodnika;
- **Wiek** _(int) (not null)_ - Wiek zawodnika;
- **Pozycja** _(varchar) (not null)_ - Pozycja zawodnika na boisku;
- **Druzyna_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Drużyny, wskazujące drużynę, do której należy zawodnik;

**Tabela Drużyny: (2)**

- **ID** _(klucz główny) (int) (not null)_ - Unikalny identyfikator drużyny;
- **Kategoria** _(varchar) (not null)_ - Kategoria drużyny;
- **Nazwa** _(varchar) (not null)_ - Nazwa drużyny;

**Tabela Harmonogram: (3)**

- **ID** _(klucz główny) (int) (not null)_ - Unikalny identyfikator meczu;
- **Data_Spotkania** _(date) (not null)_ - Data rozegrania meczu;
- **Status_Meczu** _(varchar) (not null)_ - Status meczu (Rozegrany/Nierozegrany);
- **Rozgrywki_ID** _(klucz obcy) (not null)_ - Powiązane z tabelą Rozgrywki, wskazujące jedną drużynę;
- **Druzyna_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Drużyny, wskazujące jedną drużynę;
- **Liczba_goli** _(int)_ - Liczba strzelonych goli drużyny;

**Tabela Statystyki: (4)**

- **ID** _(klucz główny) (int) (not null)_ - Unikalny identyfikator statystyki;
- **Zawodnik_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Zawodnicy, wskazujące zawodnika;
- **Mecz_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Harmonogram, wskazujące mecz;
- **Bramki** _(int) (not null)_ - Liczba bramek zdobytych przez zawodnika;
- **Asysty** _(int) (not null)_ - Liczba asyst zawodnika;
- **Zolte_Kartki** _(int) (not null)_ - Liczba żółtych kartek;
- **Czerwone_Kartki** _(int) (not null)_ - Liczba czerwonych kartek;

**Tabela Sponsorzy: (5)**

- **ID** _(klucz główny) (int) (not null)_ - Unikalny identyfikator sponsora;
- **Nazwa** _(varchar) (not null)_ - Nazwa sponsora;
- **KwotaSponsorowania** _(numeric) (not null)_ - Kwota sponsorowania;
- **Druzyna_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Drużyny, wskazujące drużynę, którą sponsoruje;

**Tabela Treningi: (6)**

- **ID** (klucz główny) (int) (not null) - Unikalny identyfikator treningu;
- **Data** (date) (not null) - Data trenignu;
- **Lokalizacja** (varchar) (not null) - Lokalizacja trenignu;
- **Druzyna_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Drużyny, wskazujące drużynę, która odbywa/ła trening;

**Tabela Finanse: (7)**

- **ID** (klucz główny) (int) (not null) - Unikalny identyfikator finansów;
- **Druzyna_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Drużyny, wskazujące drużynę, której dotyczą finanse;
- **Kwota** (int) (not null) - Kwota przychodów lub wydatków;
- **Opis** (varchar) (not null) - Opis kwoty przychodów lub wydatków;

**Tabela Rozgrywki: (8)**

- **ID** (klucz główny) (int) (not null) - Unikalny identyfikator rozgrywek;
- **Nazwa** (varchar) (not null) - Nazwa rozgrywek;
- **Data_rozpoczecia** (date) (not null) - Data rozpoczęcia rozgrywek;
- **Data_zakonczenia** (date) (not null) - Data zakończenia rozgrywek;

**Tabela Pracownicy: (9)**

- **ID** (klucz główny) (not null) (int) - Unikalny identyfikator pracownika;
- **Dane** (varchar) (not null) - Imię i nazwisko pracownika;
- **Stanowisko** (varchar) (not null) - Stanowisko pracownika;
- **Druzyna_ID** _(klucz obcy) (int) (not null)_ - Powiązane z tabelą Drużyny, wskazujące drużynę, do której przynależy pracownik;

## Relacje między tabelami

W przedstawionej bazie danych obowiązują następujące relacje między tabelami:

- **Zawodnicy - Drużyny**: Jest to relacja wiele do jednego (N:1), gdzie wielu zawodników może należeć do jednej drużyny, ale każdy zawodnik może być przypisany tylko do jednej drużyny.
- **Harmonogram - Drużyny**: Relacja ta jest wiele do jednego (N:1) i wiele do wielu (N) w przypadku dwóch drużyn uczestniczących w jednym meczu. Każdy mecz w harmonogramie może obejmować dwie drużyny, a jedna drużyna może uczestniczyć w wielu meczach.
- **Statystyki - Zawodnicy**: Relacja ta jest wiele do jednego (N:1), gdzie wiele statystyk może dotyczyć jednego zawodnika, ale każda statystyka jest związana z jednym zawodnikiem.
- **Statystyki - Harmonogram**: Jest to relacja wiele do jednego (N:1), gdzie wiele statystyk może być związanych z jednym meczem, ale każda statystyka jest przypisana do jednego meczu.
- **Sponsorzy - Drużyny**: Relacja ta jest wiele do jednego (N:1), gdzie wielu sponsorów może wspierać jedną drużynę, ale każdy sponsor może być przypisany do jednej drużyny.
- **Treningi - Drużyny:** Relacja ta jest wiele do jednego (N:1), gdzie drużyna może mieć wiele treningów, ale trening może być przypisany tylko do jednej drużyny.
- **Drużyny - Pracownicy:** Relacja ta jest wiele do jednego (N:1), gdzie drużyna może mieć wiele pracowników, ale pracownik może być przypisany tylko do jednej drużyny.
- **Harmonogram - Rozgrywki:** Relacja ta jest wiele do jednego (N:1), gdzie w harmonogramie może być wiele meczów drużyny w danych rozgrywkach, ale danego dnia można rozegrać tylko jedno spotkanie.
- **Finanse -** **Sponsorzy:** Relacja ta jest wiele do jednego (N:1), gdzie finanse mogą pochodzić od wielu sponsorów, ale sponsor jest przypisany do jednej drużyny.

Te relacje umożliwiają zintegrowanie różnych aspektów działalności klubu sportowego, zapewniając spójność i integralność danych w systemie. Dzięki temu możliwe jest śledzenie wyników zawodników, zarządzanie harmonogramami meczów oraz monitorowanie wsparcia sponsorów.

## Procedury

DODAJ_DRUŻYNĘ

Procedura dodaj_drużynę w bazie danych została zaprojektowana w celu umożliwienia dodawania nowych drużyn do systemu. Procedura ta przyjmuje dwa parametry wejściowe: nazwę drużyny (p_nazwa) oraz kategorię drużyny (p_kategoria).

Parametry wejściowe:

- **p_nazwa** (VARCHAR2): Nazwa drużyny.
- **p_kategoria** (VARCHAR2): Kategoria drużyny.

Działanie:

Procedura dodaje nowy rekord do tabeli DRUŻYNY, zawierający nazwę drużyny oraz jej kategorię. Po dodaniu rekordu, zmiany są zatwierdzane (commit) w bazie danych, co gwarantuje trwałość wprowadzonych danych.

Procedura jest tworzona za pomocą następującej instrukcji SQL:

![Obraz zawierający tekst, zrzut ekranu, wyświetlacz, Czcionka

Opis wygenerowany automatycznie]
Opis kroków:

- **INSERT INTO DRUŻYNY**: Procedura wstawia nowy rekord do tabeli DRUŻYNY przy użyciu wartości przekazanych jako parametry.
- **COMMIT**: Procedura zatwierdza transakcję, co powoduje zapisanie wprowadzonych danych w bazie danych.

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, Czcionka

Opis wygenerowany automatycznie]

POBIERZ_DRUŻYNĘ

Procedura pobierz_drużynę w bazie danych została zaprojektowana w celu umożliwienia pobierania informacji o drużynach na podstawie ich identyfikatora. Procedura ta przyjmuje jeden parametr wejściowy: identyfikator drużyny (p_id) oraz zwraca nazwę i kategorię drużyny.

Parametry wejściowe:

- **p_id** (NUMBER): Identyfikator drużyny.

Działanie:

Procedura pobiera rekord z tabeli DRUŻYNY na podstawie przekazanego identyfikatora i zwraca nazwę oraz kategorię drużyny.

Procedura jest tworzona za pomocą następującej instrukcji SQL:

![Obraz zawierający tekst, zrzut ekranu, wyświetlacz, oprogramowanie

Opis wygenerowany automatycznie]

Opis kroków:

- **SELECT INTO**: Procedura pobiera nazwę i kategorię drużyny z tabeli DRUŻYNY na podstawie identyfikatora przekazanego jako parametr.
- **RETURN**: Procedura zwraca pobrane wartości poprzez parametry wyjściowe.

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, Czcionka

Opis wygenerowany automatycznie]

USUŃ_DRUŻYNĘ

Procedura usuń_drużynę w bazie danych została zaprojektowana w celu umożliwienia usuwania istniejących drużyn z systemu na podstawie ich identyfikatora. Procedura ta przyjmuje jeden parametr wejściowy: identyfikator drużyny (p_id).

Parametry wejściowe:

- **p_id** (NUMBER): Identyfikator drużyny do usunięcia.

Działanie:

Procedura usuwa istniejący rekord w tabeli DRUŻYNY na podstawie przekazanego identyfikatora. Po usunięciu rekordu, zmiany są zatwierdzane (commit) w bazie danych, co gwarantuje trwałość wprowadzonych danych.

Procedura jest tworzona za pomocą następującej instrukcji SQL:

![Obraz zawierający tekst, zrzut ekranu, wyświetlacz, oprogramowanie

Opis wygenerowany automatycznie]

Opis kroków:

- **DELETE FROM DRUŻYNY**: Procedura usuwa istniejący rekord w tabeli DRUŻYNY na podstawie identyfikatora przekazanego jako parametr.
- **COMMIT**: Procedura zatwierdza transakcję, co powoduje zapisanie wprowadzonych zmian w bazie danych.

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, Czcionka

Opis wygenerowany automatycznie]
AKTUALIZUJ_DRUŻYNĘ

Procedura aktualizuj_drużynę w bazie danych została zaprojektowana w celu umożliwienia aktualizacji istniejących drużyn w systemie na podstawie ich identyfikatora. Procedura ta przyjmuje trzy parametry wejściowe: identyfikator drużyny (p_id), nową nazwę drużyny (p_nowa_nazwa) oraz nową kategorię drużyny (p_nowa_kategoria).

Parametry wejściowe:

- **p_id** (NUMBER): Identyfikator drużyny do zaktualizowania.
- **p_nowa_nazwa** (VARCHAR2): Nowa nazwa drużyny.
- **p_nowa_kategoria** (VARCHAR2): Nowa kategoria drużyny.

Działanie:

Procedura aktualizuje istniejący rekord w tabeli DRUŻYNY na podstawie przekazanego identyfikatora, ustawiając nową nazwę i kategorię drużyny. Po aktualizacji rekordu, zmiany są zatwierdzane (commit) w bazie danych, co gwarantuje trwałość wprowadzonych danych.

Procedura jest tworzona za pomocą następującej instrukcji SQL:

![Obraz zawierający tekst, zrzut ekranu, Czcionka, linia

Opis wygenerowany automatycznie]

Opis kroków:

- **UPDATE DRUŻYNY**: Procedura aktualizuje istniejący rekord w tabeli DRUŻYNY na podstawie przekazanego identyfikatora i nowych wartości przekazanych jako parametry.
- **COMMIT**: Procedura zatwierdza transakcję, co powoduje zapisanie wprowadzonych zmian w bazie danych.

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, Czcionka

Opis wygenerowany automatycznie]

**POBIERZ_WSZYSTKIE_DRUŻYNY**

Procedura pobierz_wszystkie_drużyny w bazie danych została zaprojektowana w celu umożliwienia pobierania wszystkich drużyn z systemu. Procedura ta przyjmuje jeden parametr wyjściowy: kursor (druzyny), który będzie zawierał wyniki zapytania.

**Parametry wyjściowe:**

- **druzyny** (OUT SYS_REFCURSOR): Kursor zawierający wyniki zapytania.

**Działanie:**

Procedura otwiera kursor dla zapytania, które pobiera wszystkie rekordy z tabeli DRUŻYNY.

**Procedura jest tworzona za pomocą następującej instrukcji SQL:**



**Opis kroków:**

- **OPEN druzyny FOR SELECT**: Procedura otwiera kursor dla zapytania, które pobiera wszystkie rekordy z tabeli DRUŻYNY.
- **RETURN**: Procedura zwraca kursor z wynikami zapytania.

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Oprogramowanie multimedialne

Opis wygenerowany automatycznie]

W projekcie występuje więcej procedur, które realizują podobne zadania w odniesieniu do innych tabel i funkcji systemu. Każda z tych procedur operuje na danych w sposób analogiczny do wyżej wymienionych przykładów, zapewniając spójność i integralność danych w bazie.

Wszystkie procedury:

![Obraz zawierający tekst, zrzut ekranu, numer, oprogramowanie

Opis wygenerowany automatycznie]
## Funkcje

W projekcie zdefiniowano kilka funkcji, które służą do wykonywania różnych operacji w bazie danych. Poniżej znajduje się opis każdej z funkcji:

**NAJLEPSI_ZAWODNICY**

Funkcja **NAJLEPSI_ZAWODNICY** zwraca trzech zawodników z największą liczbą zdobytych goli. Funkcja przetwarza dane z tabeli **STATYSTYKI**, sumując gole dla każdego zawodnika i zwracając rekordy z najwyższymi sumami.

![Obraz zawierający tekst, elektronika, zrzut ekranu, oprogramowanie

Opis wygenerowany automatycznie]

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, wyświetlacz

Opis wygenerowany automatycznie]
**NAJWIECEJ_ASYST**

Funkcja **NAJWIECEJ_ASYST** zwraca zawodnika, który ma najwięcej asyst we wszystkich meczach. Dane są pobierane z tabeli **STATYSTYKI** i sumowane dla każdego zawodnika, po czym zwracany jest zawodnik z najwyższą liczbą asyst.

![Obraz zawierający tekst, elektronika, zrzut ekranu, oprogramowanie

Opis wygenerowany automatycznie]

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie

Opis wygenerowany automatycznie]
**OBLICZ_BUDZET_DRUZYNY**

Funkcja **OBLICZ_BUDZET_DRUZYNY** oblicza łączny budżet drużyny na podstawie kwot sponsorowania i odejmuje od niej sumę finansów. Pobiera dane z tabeli **SPONSORZY** i sumuje kwoty sponsorowania dla wybranej drużyny.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Strona internetowa

Opis wygenerowany automatycznie]

Kod w PHP:

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie

Opis wygenerowany automatycznie]
**POBIERZ_SPONSOROW_FILTR**

Funkcja **POBIERZ_SPONSOROW_FILTR** zwraca listę sponsorów, filtrując je według identyfikatora drużyny. Jeśli identyfikator drużyny jest podany, funkcja zwraca tylko sponsorów przypisanych do tej drużyny; w przeciwnym razie zwraca wszystkich sponsorów.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Ikona komputerowa

Opis wygenerowany automatycznie]
**POBIERZ_STATYSTYKI_FILTR**

Funkcja **POBIERZ_STATYSTYKI_FILTR** zwraca statystyki zawodników, filtrując je według daty meczu. Funkcja przetwarza dane z tabel **STATYSTYKI** i **HARMONOGRAM**, zwracając statystyki dla meczów rozegranych w określonym dniu.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Strona internetowa

Opis wygenerowany automatycznie]

Kod w PHP:  
![Obraz zawierający tekst, zrzut ekranu

Opis wygenerowany automatycznie]

**POBIERZ_ZAWODNIKOW_FILTR**

Funkcja **POBIERZ_ZAWODNIKOW_FILTR** zwraca listę zawodników, filtrując ich według identyfikatora drużyny. Jeśli identyfikator drużyny jest podany, funkcja zwraca tylko zawodników przypisanych do tej drużyny; w przeciwnym razie zwraca wszystkich zawodników.

![Obraz zawierający tekst, elektronika, zrzut ekranu, oprogramowanie

Opis wygenerowany automatycznie]

## Triggery

W projekcie zdefiniowano wiele triggerów, które są używane do różnych celów, takich jak automatyczne generowanie wartości kluczy głównych, zapewnianie integralności danych oraz uruchamianie specyficznych operacji biznesowych w odpowiedzi na zmiany w bazie danych. Poniżej znajduje się opis jednego z triggerów użytych w projekcie:

**TRIGGER: DRUZYNY_AUTOINCREMENT**

Ten trigger jest odpowiedzialny za automatyczne przypisywanie wartości dla kolumny ID w tabeli **DRUZYNY** przed każdą operacją wstawiania nowego rekordu. Dzięki temu nie ma potrzeby ręcznego ustawiania wartości dla klucza głównego, co ułatwia zarządzanie danymi i zapewnia unikalność identyfikatorów.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Ikona komputerowa

Opis wygenerowany automatycznie]

**Opis działania:**

- **Typ triggera:** BEFORE INSERT
- **Tabela:** DRUZYNY
- **Zakres:** Dla każdego nowego wiersza (FOR EACH ROW)

**Szczegóły:**

- Trigger uruchamia się przed każdą operacją wstawienia nowego rekordu do tabeli **DRUZYNY**.
- Generuje nową wartość dla kolumny ID za pomocą sekwencji **druzyny_seq** i przypisuje ją do nowo wstawianego rekordu (:NEW.id := druzyny_seq.NEXTVAL;).

**Zastosowanie:**

Ten trigger zapewnia, że każdy nowy rekord w tabeli **DRUZYNY** otrzymuje unikalny identyfikator, co jest kluczowe dla zachowania integralności danych w bazie. Automatyzacja tego procesu eliminuje ryzyko błędów wynikających z ręcznego przypisywania identyfikatorów i upraszcza operacje wstawiania nowych rekordów.

Wszystkie triggery:

![Obraz zawierający tekst, zrzut ekranu, numer, oprogramowanie

Opis wygenerowany automatycznie]
## Sekwencje

W projekcie wykorzystano wiele sekwencji, które służą do generowania unikalnych wartości identyfikatorów dla różnych tabel. Poniżej znajduje się opis jednej z sekwencji oraz przykład jej użycia.

Przykład sekwencji: **DRUZYNY_SEQ**

Sekwencja **DRUZYNY_SEQ** jest używana do generowania unikalnych identyfikatorów dla tabeli **DRUZYNY**. Poniżej znajdują się szczegóły tej sekwencji:

![Obraz zawierający tekst, elektronika, zrzut ekranu, oprogramowanie

Opis wygenerowany automatycznie]

Wszystkie sekwencje:

![Obraz zawierający tekst, zrzut ekranu, numer, Czcionka

Opis wygenerowany automatycznie]
Każda z tych sekwencji pełni podobną funkcję, generując unikalne identyfikatory dla odpowiednich tabel w bazie danych.

Sekwencje te są kluczowe dla zapewnienia integralności danych i unikalności identyfikatorów, co jest niezbędne w systemach zarządzania bazami danych.

# GUI

![Obraz zawierający tekst, zrzut ekranu, osoba

Opis wygenerowany automatycznie]

Główny widok strony po uruchomieniu aplikacji. Do logowania przechodzimy poprzez wciśnięciu przycisku w prawym górnym rogu.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Czcionka

Opis wygenerowany automatycznie]

Panel logowania dla admina strony. W pola wpisujemy odpowiednie dane i wciskamy przycisk „Zaloguj".

Przykładowe logowanie dla admina:

**Login:** admin  
**Hasło:** admin

Drużyny:

![Obraz zawierający tekst, zrzut ekranu, logo, oprogramowanie

Opis wygenerowany automatycznie]

Strona „drużyny", w której wyświetlane są informacje o każdej drużynie, która należy do klubu.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Ikona komputerowa

Opis wygenerowany automatycznie]

Widok strony „drużyny" dla osoby zalogowanej. Może ona dodać nową drużynę, edytować informacje o istniejącej lub usunąć zespół.

![Obraz zawierający tekst, zrzut ekranu, Czcionka, oprogramowanie

Opis wygenerowany automatycznie]

Edycja.

![Obraz zawierający tekst, zrzut ekranu, Czcionka, oprogramowanie

Opis wygenerowany automatycznie]
Dodawanie.

Finanse:

![Obraz zawierający tekst, zrzut ekranu, logo, Strona internetowa

Opis wygenerowany automatycznie]
Strona „finanse", w której pojawiają się informacje o przychodach lub wydatkach w danym zespole.

Budżet:

![Obraz zawierający tekst, zrzut ekranu, logo, oprogramowanie

Opis wygenerowany automatycznie]

Strona „budżet", w której wyświetlane są informacje o stanie budżetu wszystkich zespołów. Kwota obliczana jest na podstawie sumowania i odejmowania przychodów i wydatków.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Ikona komputerowa

Opis wygenerowany automatycznie]

Panel edycji/usuwania i dodawania finansów.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Czcionka

Opis wygenerowany automatycznie]

Edycja.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, System operacyjny

Opis wygenerowany automatycznie]

Strona „treningi", w której mamy możliwość sprawdzenia daty oraz miejsca treningu dla drużyn.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Ikona komputerowa

Opis wygenerowany automatycznie]

Panel edycji/usuwania.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, System operacyjny

Opis wygenerowany automatycznie]

Edycja.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, System operacyjny

Opis wygenerowany automatycznie]

Dodawanie.

Zawodnicy:

![Obraz zawierający tekst, zrzut ekranu, logo, godło

Opis wygenerowany automatycznie]

Strona „zawodnicy", w której widnieją informacje o zawodnikach takie jak imię i nazwisko, wiek, pozycja oraz do której drużyny przynależy dany zawodnik.

![Obraz zawierający tekst, Strona internetowa, oprogramowanie, zrzut ekranu

Opis wygenerowany automatycznie]

Mamy możliwość filtrowania zawodników względem drużyn, do których przynależą.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Ikona komputerowa

Opis wygenerowany automatycznie]

Panel edycji/usuwania również posiada filtr, który ułatwia pracę adminowi.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Czcionka

Opis wygenerowany automatycznie]

Edycja.

![Obraz zawierający tekst, zrzut ekranu, oprogramowanie, Strona internetowa

Opis wygenerowany automatycznie

Dodawanie.

# Funkcjonalności aplikacji

Aplikacja do zarządzania klubem piłkarskim została zaprojektowana w celu efektywnego zarządzania danymi związanych z drużynami sportowymi, zawodnikami, harmonogramem meczów, statystykami oraz sponsorami. Poniżej znajduje się szczegółowy opis kluczowych funkcjonalności aplikacji:

- **Zarządzanie drużynami**
  - **Dodawanie nowych drużyn**: Administratorzy mogą dodawać nowe drużyny do bazy danych, wprowadzając szczegółowe informacje o drużynie, takie jak nazwa, budżet, kategoria.
  - **Aktualizacja danych drużyn**: System umożliwia edytowanie danych istniejących drużyn, w tym aktualizację budżetu, nazwy oraz kategorii.
  - **Przeglądanie drużyn**: Użytkownicy mogą przeglądać listę drużyn, sortować je według kategorii oraz wyszukiwać konkretne drużyny na podstawie różnych kryteriów.
- **Zarządzanie zawodnikami**
  - **Rejestracja nowych zawodników**: Nowi zawodnicy mogą być dodawani do bazy danych z informacjami takimi jak imię, nazwisko, wiek, pozycja oraz przynależność do drużyny.
  - **Edycja danych zawodników**: Możliwość aktualizacji danych zawodników, w tym zmiany drużyny, edycji pozycji, wieku oraz innych danych personalnych.
  - **Przeglądanie zawodników**: Użytkownicy mogą przeglądać listę zawodników, sortować je według drużyn, pozycji oraz wyszukiwać konkretnych zawodników na podstawie różnych kryteriów.
- **Zarządzanie harmonogramem meczów**
  - **Tworzenie harmonogramu meczów**: Administratorzy mogą dodawać nowe mecze do harmonogramu, wprowadzając datę, drużyny biorące udział oraz status meczu (np. zaplanowany, rozegrany).
  - **Aktualizacja harmonogramu**: Możliwość edycji danych dotyczących meczów, w tym zmiany daty, statusu oraz drużyn biorących udział.
  - **Przeglądanie harmonogramu**: Użytkownicy mogą przeglądać harmonogram meczów, sortować je według daty oraz wyszukiwać konkretne mecze na podstawie różnych kryteriów.
- **Zarządzanie statystykami**
  - **Dodawanie statystyk meczowych**: Administratorzy mogą dodawać statystyki dotyczące rozegranych meczów, takie jak liczba bramek, asysty, żółte i czerwone kartki dla każdego zawodnika.
  - **Aktualizacja statystyk**: Możliwość edycji statystyk meczowych, w tym korekta liczby bramek, asyst oraz kart.
  - **Przeglądanie statystyk**: Użytkownicy mogą przeglądać statystyki meczowe, sortować je według zawodników, drużyn oraz wyszukiwać konkretne statystyki na podstawie różnych kryteriów.
- **Zarządzanie sponsorami**
  - **Dodawanie nowych sponsorów**: Administratorzy mogą dodawać nowych sponsorów do bazy danych, wprowadzając szczegółowe informacje o sponsorze, takie jak nazwa, kwota sponsorowania oraz przypisana drużyna.
  - **Aktualizacja danych sponsorów**: Możliwość edycji danych istniejących sponsorów, w tym zmiany kwoty sponsorowania oraz przypisania do drużyny.
  - **Przeglądanie sponsorów**: Użytkownicy mogą przeglądać listę sponsorów, sortować je według drużyn oraz wyszukiwać konkretnych sponsorów na podstawie różnych kryteriów.
- **Zarządzanie finansami drużyn**
  - **Obliczanie budżetu drużyn**: Funkcje obliczające całkowity budżet drużyn na podstawie danych sponsorowania oraz innych przychodów.
  - **Przeglądanie finansów**: Użytkownicy mogą przeglądać informacje finansowe drużyn, sortować je według wysokości budżetu oraz analizować dane finansowe na podstawie różnych kryteriów.

Te funkcjonalności zapewniają kompleksowe zarządzanie danymi sportowymi, umożliwiając efektywną administrację drużynami, zawodnikami, harmonogramem meczów, statystykami oraz sponsorami.

