# Instrukcja uruchomienia projektu - Księga Gości

## Wymagania wstępne

Przed rozpoczęciem upewnij się, że masz zainstalowane:

1. **XAMPP** lub **WAMP** - lokalne środowisko serwerowe
   - Pobierz XAMPP: https://www.apachefriends.org/
   - Pobierz WAMP: https://www.wampserver.com/

2. **Przeglądarka internetowa** - najlepiej Chrome lub Firefox

3. **Edytor kodu** - np. VS Code, Sublime Text, lub PHPStorm

---

## Krok 1: Przygotowanie środowiska

### Dla XAMPP:

1. Zainstaluj XAMPP
2. Uruchom **XAMPP Control Panel**
3. Uruchom serwisy:
   - Kliknij **Start** przy Apache
   - Kliknij **Start** przy MySQL

### Dla WAMP:

1. Zainstaluj WAMP
2. Uruchom WAMP Server
3. Sprawdź czy ikona w tray jest **zielona**

---

## Krok 2: Kopiowanie plików projektu

1. Zlokalizuj folder projektu: `ksiega-gosci/`

2. **Dla XAMPP**:
   - Skopiuj cały folder `ksiega-gosci/` do `C:\xampp\htdocs\`
   - Ścieżka powinna być: `C:\xampp\htdocs\ksiega-gosci\`

3. **Dla WAMP**:
   - Skopiuj cały folder `ksiega-gosci/` do `C:\wamp64\www\`
   - Ścieżka powinna być: `C:\wamp64\www\ksiega-gosci\`

---

## Krok 3: Utworzenie bazy danych

### Metoda 1: Przez phpMyAdmin (ZALECANA)

1. Otwórz przeglądarkę i wejdź na: `http://localhost/phpmyadmin`

2. Kliknij zakładkę **SQL** w górnym menu

3. Otwórz plik `sql/schema.sql` w edytorze tekstu

4. Skopiuj **całą zawartość** pliku

5. Wklej do okna SQL w phpMyAdmin

6. Kliknij przycisk **Wykonaj** (Execute)

7. Po lewej stronie powinieneś zobaczyć bazę danych `ksiega_gosci` z tabelami:
   - users
   - categories
   - entries

### Metoda 2: Przez Import

1. W phpMyAdmin kliknij **Nowa baza danych**

2. Nazwa: `ksiega_gosci`, Kodowanie: `utf8mb4_unicode_ci`

3. Kliknij **Utwórz**

4. Wybierz bazę `ksiega_gosci` z listy po lewej

5. Kliknij zakładkę **Import**

6. Wybierz plik `sql/schema.sql`

7. Kliknij **Wykonaj**

---

## Krok 4: Konfiguracja aplikacji

1. Otwórz plik `config.php` w edytorze

2. Sprawdź ustawienia bazy danych:

```php
define('DB_HOST', 'localhost');     // Zazwyczaj localhost
define('DB_NAME', 'ksiega_gosci');  // Nazwa bazy danych
define('DB_USER', 'root');          // Użytkownik (domyślnie root)
define('DB_PASS', '');              // Hasło (domyślnie puste)
```

3. Jeśli masz inne ustawienia (np. hasło do MySQL), zmień je tutaj

4. **OPCJONALNIE**: Zmień `CSRF_SECRET` na własny losowy ciąg znaków:

```php
define('CSRF_SECRET', 'twoj_unikalny_tajny_klucz_12345');
```

5. Zapisz plik

---

## Krok 5: Uruchomienie aplikacji

1. Otwórz przeglądarkę

2. Wpisz adres: `http://localhost/ksiega-gosci/`

3. Powinieneś zobaczyć stronę główną Księgi Gości

4. Jeśli widzisz błąd:
   - Sprawdź czy Apache i MySQL są uruchomione
   - Sprawdź czy baza danych została utworzona
   - Sprawdź czy ścieżka jest poprawna

---

## Krok 6: Testowanie aplikacji

### Zaloguj się na testowe konto:

1. Kliknij **Logowanie** w menu

2. Użyj jednego z testowych kont:

   **Administrator:**
   - Login: `admin`
   - Hasło: `test123`

   **Zwykły użytkownik:**
   - Login: `jankowalski`
   - Hasło: `test123`

3. Po zalogowaniu powinieneś zobaczyć:
   - Swoje imię w menu
   - Przycisk "Dodaj wpis"
   - Przycisk "Panel użytkownika"

### Przetestuj funkcje:

- ✓ Dodaj nowy wpis
- ✓ Zobacz swoje wpisy w panelu użytkownika
- ✓ Przeglądaj wpisy na stronie głównej
- ✓ Filtruj wpisy po kategorii
- ✓ Wyloguj się

---

## Rozwiązywanie problemów

### Problem: Strona nie ładuje się

**Rozwiązanie:**
- Sprawdź czy Apache jest uruchomiony (XAMPP/WAMP Control Panel)
- Sprawdź adres URL: `http://localhost/ksiega-gosci/`
- Wyczyść cache przeglądarki (Ctrl + F5)

### Problem: Błąd połączenia z bazą danych

**Rozwiązanie:**
- Sprawdź czy MySQL jest uruchomiony
- Sprawdź ustawienia w `config.php`
- Sprawdź czy baza `ksiega_gosci` istnieje w phpMyAdmin

### Problem: Błąd 404 - strona nie znaleziona

**Rozwiązanie:**
- Sprawdź czy folder znajduje się w `htdocs/` (XAMPP) lub `www/` (WAMP)
- Sprawdź czy nazwa folderu to `ksiega-gosci`
- Spróbuj: `http://localhost/ksiega-gosci/index.php`

### Problem: Strona wygląda bez stylów

**Rozwiązanie:**
- Sprawdź czy folder `css/` istnieje
- Sprawdź czy plik `css/style.css` istnieje
- Otwórz DevTools (F12) i sprawdź zakładkę Console czy są błędy

### Problem: Formularze nie działają

**Rozwiązanie:**
- Sprawdź czy JavaScript jest włączony
- Otwórz DevTools (F12) i sprawdź zakładkę Console
- Sprawdź czy pliki JavaScript ładują się poprawnie

---

## Następne kroki

Gratulacje! Projekt działa! 🎉

Teraz przejdź do:

1. **`PRZEWODNIK_UCZNIA.md`** - dowiedz się co i jak się uczyć
2. **`ZADANIA.md`** - zobacz listę zadań do wykonania
3. **`CHECKLIST_EGZAMIN.md`** - sprawdź wymagania egzaminacyjne

---

## Potrzebujesz pomocy?

Jeśli coś nie działa:

1. Przeczytaj sekcję "Rozwiązywanie problemów" powyżej
2. Sprawdź komentarze w kodzie - są tam wskazówki
3. Użyj DevTools przeglądarki (F12) do debugowania
4. Sprawdź logi błędów Apache w XAMPP/WAMP

---

**Powodzenia w nauce! 🚀**
