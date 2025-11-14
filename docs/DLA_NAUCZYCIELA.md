# Informacje dla nauczyciela / instruktora

## O projekcie

**Księga Gości** to kompletny projekt edukacyjny stworzony do nauczania programowania aplikacji webowych na poziomie średnim (technikum informatyczne, kwalifikacja INF.03).

---

## Cele dydaktyczne

### Wiedza

Uczeń pozna i zrozumie:
- Strukturę aplikacji webowej (frontend + backend + baza danych)
- Bezpieczne programowanie (SQL Injection, XSS, CSRF)
- Architekturę klient-serwer
- Protokoły HTTP (GET, POST)
- Sesje i cookies
- Relacyjne bazy danych
- Responsive web design

### Umiejętności

Uczeń będzie potrafił:
- Stworzyć responsywną stronę WWW (HTML5, CSS3)
- Walidować formularze (JavaScript)
- Programować backend (PHP)
- Projektować i tworzyć bazę danych (MySQL)
- Zabezpieczać aplikację (prepared statements, hashing)
- Debugować kod (DevTools)
- Testować aplikację

### Kompetencje

Uczeń nabędzie:
- Samodzielność w rozwiązywaniu problemów
- Umiejętność czytania dokumentacji
- Analityczne myślenie
- Uwagę na bezpieczeństwo
- Dobre praktyki programistyczne

---

## Metodyka nauczania

### Podejście "Learning by Doing"

Projekt wykorzystuje metodę aktywnego uczenia się:
1. **70% kodu gotowego** - do analizy i nauki
2. **20% do uzupełnienia** - zadania TODO
3. **10% rozszerzeń** - dla ambitnych uczniów

### Progresja trudności

**Tydzień 1-2:** Analiza gotowego kodu
- Uruchomienie projektu
- Zrozumienie struktury
- Analiza poszczególnych komponentów

**Tydzień 3-4:** Wykonanie zadań obowiązkowych
- Walidacja formularzy (JavaScript)
- Dodawanie wpisu (PHP)
- AJAX (opcjonalnie)

**Tydzień 5-6:** Rozszerzenia
- Wyszukiwanie, sortowanie
- Panel moderatora
- Własne pomysły uczniów

---

## Plan lekcji (przykładowy)

### Lekcja 1-2: Wprowadzenie i uruchomienie (4h)

**Cele:**
- Uruchomienie projektu lokalnie
- Zrozumienie struktury aplikacji
- Poznanie narzędzi (XAMPP, phpMyAdmin)

**Przebieg:**
1. Prezentacja projektu (15 min)
2. Instalacja XAMPP (30 min)
3. Uruchomienie projektu (30 min)
4. Prezentacja funkcjonalności (15 min)
5. Analiza struktury katalogów (30 min)
6. Zadanie domowe: Przetestuj wszystkie funkcje

---

### Lekcja 3-4: Baza danych (4h)

**Cele:**
- Zrozumienie struktury bazy danych
- Poznanie relacji między tabelami
- Podstawy SQL

**Przebieg:**
1. Analiza `schema.sql` (30 min)
2. Diagramy E/R (30 min)
3. Wprowadzenie do SQL (SELECT, JOIN) (60 min)
4. Praktyka w phpMyAdmin (60 min)
5. Zadanie: Napisz 10 własnych zapytań SQL

---

### Lekcja 5-6: Frontend - HTML/CSS (4h)

**Cele:**
- HTML semantyczny
- CSS responsywny
- Flexbox

**Przebieg:**
1. Analiza `index.php` - struktura HTML (30 min)
2. Analiza `style.css` - zmienne CSS, Flexbox (60 min)
3. Media queries i responsywność (30 min)
4. DevTools - testowanie responsywności (30 min)
5. Zadanie: Zmień kolory i czcionki

---

### Lekcja 7-8: JavaScript - walidacja (4h)

**Cele:**
- Walidacja formularzy
- Wyrażenia regularne
- DOM manipulation

**Przebieg:**
1. Podstawy JavaScript (zmienne, funkcje) (30 min)
2. Analiza `validation.js` (45 min)
3. Wyrażenia regularne (RegEx) (45 min)
4. **ZADANIE 1, 2, 3** - wykonanie przez uczniów (90 min)

---

### Lekcja 9-10: PHP - backend (4h)

**Cele:**
- Podstawy PHP
- Prepared statements
- Sesje

**Przebieg:**
1. Podstawy PHP (zmienne, tablice, funkcje) (30 min)
2. Analiza `login.php` (45 min)
3. PDO i prepared statements (45 min)
4. Sesje w PHP (30 min)
5. **ZADANIE 6** - dodawanie wpisu (60 min)

---

### Lekcja 11-12: Bezpieczeństwo (4h)

**Cele:**
- SQL Injection
- XSS
- CSRF
- Hashing haseł

**Przebieg:**
1. Czym są ataki? (prezentacja) (30 min)
2. SQL Injection - demonstracja i ochrona (45 min)
3. XSS - demonstracja i ochrona (30 min)
4. CSRF - tokeny (30 min)
5. Hashing haseł (30 min)
6. Code review - znajdź luki (45 min)

---

### Lekcja 13-14: AJAX (opcjonalnie) (4h)

**Cele:**
- Komunikacja asynchroniczna
- Fetch API
- JSON

**Przebieg:**
1. Wprowadzenie do AJAX (30 min)
2. Fetch API (45 min)
3. JSON (30 min)
4. **ZADANIE 4** - AJAX ładowanie (90 min)
5. **ZADANIE 5** - usuwanie przez AJAX (opcjonalnie)

---

### Lekcja 15-16: Projekt własny (4h)

**Cele:**
- Zastosowanie wiedzy w praktyce
- Rozszerzenia według własnych pomysłów

**Przebieg:**
1. Wybór rozszerzenia (15 min)
2. Planowanie implementacji (30 min)
3. Implementacja (3h)
4. Prezentacje (15 min)

---

## System oceniania

### Ocena ciągła (60%)

**Zadania obowiązkowe (TODO):**
- ZADANIE 1: Walidacja email (10%)
- ZADANIE 2: Walidacja hasła (10%)
- ZADANIE 3: Walidacja formularza wpisu (10%)
- ZADANIE 6: Dodawanie wpisu do bazy (20%)
- Aktywność na zajęciach (10%)

### Projekt końcowy (40%)

**Rozszerzenie funkcjonalności (wybierz minimum 2):**
- Wyszukiwanie (10-15%)
- Sortowanie (5-10%)
- Panel moderatora (15-20%)
- Edycja wpisów (10-15%)
- AJAX API (15-20%)
- Własny pomysł (10-20%)

### Kryteria oceny projektu końcowego:

| Kryterium | Punkty | Opis |
|-----------|--------|------|
| Funkcjonalność | 40% | Czy działa zgodnie z założeniami? |
| Kod | 30% | Czytelność, komentarze, struktura |
| Bezpieczeństwo | 20% | Prepared statements, escape, walidacja |
| Dokumentacja | 10% | README, komentarze |

---

## Wskazówki dydaktyczne

### ✅ DO:

1. **Zachęcaj do eksperymentowania**
   - "Co się stanie gdy zmienisz to na...?"
   - "Spróbuj celowo wprowadzić błąd i zobacz komunikat"

2. **Ucz debugowania**
   - Pokazuj DevTools (F12)
   - Ucz używania `console.log()` i `var_dump()`
   - Analizuj błędy razem z uczniami

3. **Podkreślaj bezpieczeństwo**
   - "ZAWSZE używaj prepared statements"
   - "NIGDY nie wyświetlaj danych użytkownika bez escape"
   - "ZAWSZE hashuj hasła"

4. **Pokazuj praktyczne zastosowania**
   - "Tak działają prawdziwe systemy logowania"
   - "Facebook używa podobnych mechanizmów"

5. **Wspieraj samodzielność**
   - Najpierw niech spróbują sami
   - Potem podaj wskazówkę
   - Na końcu pokaż rozwiązanie

### ❌ NIE:

1. **Nie dawaj gotowych rozwiązań od razu**
   - Pozwól uczniom myśleć i próbować
   - Podawaj wskazówki, nie kod

2. **Nie pomijaj bezpieczeństwa**
   - To kluczowy element egzaminu
   - Wyjaśnij "dlaczego" nie tylko "jak"

3. **Nie zakładaj wiedzy**
   - Sprawdź poziom grupy
   - Dostosuj tempo do uczniów

4. **Nie ignoruj błędów**
   - Błędy to najlepsza lekcja
   - Analizujcie błędy razem

---

## Materiały dodatkowe

### Prezentacje (do przygotowania przez nauczyciela)

1. **Wprowadzenie do projektu** (15 min)
   - Czym jest aplikacja webowa?
   - Architektura klient-serwer
   - Przegląd technologii

2. **Bezpieczeństwo aplikacji** (30 min)
   - SQL Injection - demonstracja
   - XSS - demonstracja
   - Dobre praktyki

3. **Przygotowanie do egzaminu** (45 min)
   - Struktura egzaminu INF.03
   - Typowe zadania
   - Wskazówki

### Ćwiczenia dodatkowe

1. **SQL Challenges**
   - Napisz zapytanie zwracające...
   - Zoptymalizuj to zapytanie...
   - Znajdź błąd w tym SQL...

2. **Code Review**
   - Znajdź luki bezpieczeństwa w tym kodzie
   - Popraw ten kod
   - Co jest nie tak z tą funkcją?

3. **Debugging Challenges**
   - Kod ma 5 błędów - znajdź i popraw
   - Dlaczego to nie działa?

---

## FAQ dla nauczycieli

### Czy mogę modyfikować projekt?

**TAK!** Projekt jest otwarty. Możesz:
- Dostosować do poziomu grupy
- Dodać/usunąć funkcje
- Zmienić zadania
- Stworzyć własne rozszerzenia

### Ile czasu potrzeba na cały projekt?

**32-48 godzin lekcyjnych** (16-24 lekcje po 2h)

Możesz dostosować do swojego harmonogramu:
- Podstawy (16h): Tylko obowiązkowe zadania
- Standardowy (32h): Obowiązkowe + wybrane rozszerzenia
- Rozszerzony (48h): Wszystko + projekt własny

### Co jeśli uczniowie mają różny poziom?

**Zróżnicuj zadania:**
- Początkujący: Tylko zadania obowiązkowe
- Średniozaawansowani: + 2-3 rozszerzenia
- Zaawansowani: + własny projekt, mentoring innych

### Czy to wystarczy na egzamin INF.03?

**TAK!** Projekt pokrywa 100% wymagań z podstawy programowej. Uczniowie, którzy zrozumieją ten projekt, są gotowi na egzamin.

---

## Dodatkowe zasoby

### Dla nauczyciela:

- **Podstawa programowa INF.03** - załączona w projekcie
- **Arkusze egzaminacyjne** - https://cke.gov.pl/
- **Dokumentacja PHP** - https://www.php.net/manual/pl/
- **MDN Web Docs** - https://developer.mozilla.org/pl/

### Dla uczniów:

- W projekcie w folderze `docs/`
- W3Schools, JavaScript.info
- YouTube: traversy Media, Web Dev Simplified

---

## Kontakt i wsparcie

Jeśli masz pytania dotyczące projektu:
1. Sprawdź dokumentację
2. Zobacz komentarze w kodzie
3. Przeanalizuj przykłady

---

## Licencja

Projekt jest darmowy i otwarty. Możesz go używać w celach edukacyjnych bez ograniczeń.

---

**Powodzenia w nauczaniu! 👨‍🏫👩‍🏫**

_Dobry nauczyciel nie daje ryby, ale uczy łowić._ 🎣
