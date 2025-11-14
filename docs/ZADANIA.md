# Zadania do wykonania - Księga Gości

Ten dokument zawiera listę zadań, które powinieneś wykonać samodzielnie, aby nauczyć się programowania aplikacji webowych zgodnie z wymaganiami egzaminu INF.03.

---

## ZADANIA OBOWIĄZKOWE (TODO w kodzie)

Zadania oznaczone jako `TODO DLA UCZNIA` w plikach projektu.

### ZADANIE 1: Walidacja email (JavaScript)

**Plik:** `js/validation.js` (linia ~55)
**Funkcja:** `validateRegistrationForm()`

**Co zrobić:**
1. Sprawdź czy pole email nie jest puste
2. Sprawdź czy email jest w poprawnym formacie
3. Użyj wyrażenia regularnego: `/^[^\s@]+@[^\s@]+\.[^\s@]+$/`
4. Jeśli błąd, użyj `showError('komunikat', 'email-error')`
5. Ustaw `isValid = false` jeśli walidacja nie przeszła

**Wskazówka:**
```javascript
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
} else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

**Sprawdzenie:** Wypełnij formularz rejestracji z błędnym emailem i zobacz czy wyświetla się błąd.

---

### ZADANIE 2: Walidacja hasła (JavaScript)

**Plik:** `js/validation.js` (linia ~70)
**Funkcja:** `validateRegistrationForm()`

**Co zrobić:**
1. Sprawdź czy hasło nie jest puste
2. Sprawdź czy hasło ma minimum 6 znaków
3. **OPCJONALNIE:** Sprawdź czy hasło zawiera wielką literę i cyfrę
4. Użyj `showError('komunikat', 'password-error')`

**Wskazówka - wersja podstawowa:**
```javascript
if (password === '') {
    showError('Hasło jest wymagane', 'password-error');
    isValid = false;
} else if (password.length < 6) {
    showError('Hasło musi mieć minimum 6 znaków', 'password-error');
    isValid = false;
}
```

**Wskazówka - wersja zaawansowana (opcjonalnie):**
```javascript
else if (!/[A-Z]/.test(password)) {
    showError('Hasło musi zawierać wielką literę', 'password-error');
    isValid = false;
} else if (!/[0-9]/.test(password)) {
    showError('Hasło musi zawierać cyfrę', 'password-error');
    isValid = false;
}
```

**Sprawdzenie:** Wpisz krótkie hasło (np. "abc") i zobacz czy wyświetla się błąd.

---

### ZADANIE 3: Walidacja formularza wpisu (JavaScript)

**Plik:** `js/validation.js` (linia ~128)
**Funkcja:** `validateEntryForm()`

**Co zrobić:**
1. Sprawdź czy tytuł nie jest pusty
2. Sprawdź czy tytuł ma minimum 5 znaków
3. Sprawdź czy tytuł nie przekracza 200 znaków
4. Sprawdź czy treść nie jest pusta
5. Sprawdź czy treść ma minimum 10 znaków
6. Użyj odpowiednich `showError()` dla 'title-error' i 'content-error'

**Wskazówka:**
```javascript
if (title === '') {
    showError('Tytuł jest wymagany', 'title-error');
    isValid = false;
} else if (title.length < 5) {
    showError('Tytuł musi mieć minimum 5 znaków', 'title-error');
    isValid = false;
} else if (title.length > 200) {
    showError('Tytuł może mieć maksymalnie 200 znaków', 'title-error');
    isValid = false;
}

if (content === '') {
    showError('Treść jest wymagana', 'content-error');
    isValid = false;
} else if (content.length < 10) {
    showError('Treść musi mieć minimum 10 znaków', 'content-error');
    isValid = false;
}
```

**Sprawdzenie:** Spróbuj dodać wpis z pustym tytułem lub krótką treścią.

---

### ZADANIE 4: AJAX - ładowanie wpisów (JavaScript)

**Plik:** `js/ajax-handlers.js` (linia ~18)
**Funkcja:** `loadEntries()`

**Co zrobić:**
1. URL jest już przygotowany
2. Użyj `fetch(url)` do wysłania zapytania
3. Sprawdź czy `response.ok`
4. Przekształć odpowiedź do JSON: `response.json()`
5. Wywołaj `displayEntries(data.entries)` jeśli `data.success === true`
6. Obsłuż błędy w `.catch()`

**Wskazówka:**
```javascript
fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Błąd HTTP: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        hideLoadingIndicator();
        if (data.success) {
            displayEntries(data.entries);
        } else {
            alert('Błąd: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Błąd AJAX:', error);
        hideLoadingIndicator();
        alert('Wystąpił błąd podczas ładowania wpisów');
    });
```

**Sprawdzenie:** Będzie działać gdy stworzysz plik `php/api-handler.php` (zadanie rozszerzające).

---

### ZADANIE 6: Dodawanie wpisu do bazy (PHP)

**Plik:** `pages/add-entry.php` (linia ~55)

**Co zrobić:**
1. Pobierz adres IP używając `getUserIP()`
2. Przygotuj zapytanie INSERT do tabeli `entries`
3. Użyj prepared statement
4. Wykonaj zapytanie
5. Jeśli sukces, ustaw flash message i przekieruj
6. Jeśli błąd, dodaj do tablicy `$errors`

**Wskazówka:**
```php
if (empty($errors)) {
    $user_id = $_SESSION['user_id'];
    $ip_address = getUserIP();

    try {
        $stmt = $db->prepare("
            INSERT INTO entries (user_id, category_id, title, content, ip_address)
            VALUES (?, ?, ?, ?, ?)
        ");

        $result = $stmt->execute([
            $user_id,
            $category_id, // może być NULL
            $title,
            $content,
            $ip_address
        ]);

        if ($result) {
            setFlashMessage('Wpis został dodany pomyślnie!', 'success');
            redirect('../index.php');
        } else {
            $errors[] = 'Nie udało się dodać wpisu.';
        }

    } catch (PDOException $e) {
        if (DEBUG_MODE) {
            $errors[] = 'Błąd bazy danych: ' . $e->getMessage();
        } else {
            $errors[] = 'Wystąpił błąd podczas dodawania wpisu.';
        }
    }
}
```

**Sprawdzenie:** Zaloguj się, dodaj wpis przez formularz. Powinien pojawić się na stronie głównej.

---

## ZADANIA ROZSZERZAJĄCE

Te zadania nie są obowiązkowe, ale świetnie rozwiną Twoje umiejętności!

### ZADANIE 5: Usuwanie wpisu przez AJAX

**Plik:** `js/ajax-handlers.js` (linia ~72)
**Funkcja:** `deleteEntry()`

**Co zrobić:**
1. Utwórz obiekt `FormData`
2. Dodaj parametry: action, entry_id, csrf_token
3. Użyj `fetch()` z metodą POST
4. Po sukcesie odśwież listę wpisów
5. Pokaż komunikat

**Poziom trudności:** ⭐⭐⭐

---

### ZADANIE 7: Wyszukiwanie wpisów

**Gdzie:** Nowy plik lub rozszerzenie `index.php`

**Co zrobić:**
1. Dodaj pole input do wyszukiwania
2. Stwórz funkcję w JavaScript do wysyłania zapytania
3. Zmodyfikuj SQL w `index.php` aby obsługiwał wyszukiwanie
4. Wyświetl wyniki

**Poziom trudności:** ⭐⭐

---

### ZADANIE 8: Sortowanie wpisów

**Gdzie:** `index.php`

**Co zrobić:**
1. Dodaj select z opcjami sortowania:
   - Najnowsze
   - Najstarsze
   - Alfabetycznie A-Z
   - Alfabetycznie Z-A
2. Zmodyfikuj zapytanie SQL aby obsługiwało sortowanie
3. Wyświetl posortowane wpisy

**Poziom trudności:** ⭐

---

### ZADANIE 9: Panel moderatora

**Gdzie:** Nowy plik `pages/moderator.php`

**Co zrobić:**
1. Sprawdź czy użytkownik ma rolę 'moderator' lub 'admin'
2. Wyświetl wszystkie wpisy (również niezatwierdzone)
3. Dodaj przyciski:
   - Zatwierdź wpis
   - Usuń wpis
4. Zaimplementuj akcje w PHP

**Poziom trudności:** ⭐⭐⭐

---

### ZADANIE 10: Edycja własnych wpisów

**Gdzie:** Nowy plik `pages/edit-entry.php`

**Co zrobić:**
1. Sprawdź czy wpis należy do zalogowanego użytkownika
2. Wyświetl formularz z obecnymi danymi
3. Zaimplementuj UPDATE w bazie danych
4. Dodaj przycisk "Edytuj" w panelu użytkownika

**Poziom trudności:** ⭐⭐

---

### ZADANIE 11: API endpoint (AJAX)

**Gdzie:** Nowy plik `php/api-handler.php`

**Co zrobić:**
1. Obsługuj różne akcje przez parametr `action`
2. Zwracaj odpowiedzi w formacie JSON
3. Zaimplementuj akcje:
   - `get_entries` - pobierz wpisy
   - `delete_entry` - usuń wpis (moderator)
   - `approve_entry` - zatwierdź wpis (moderator)

**Poziom trudności:** ⭐⭐⭐

---

### ZADANIE 12: Responsywne hamburger menu

**Gdzie:** `js/main.js` + `css/style.css`

**Co zrobić:**
1. Dodaj przycisk hamburger (☰) w CSS
2. Ukryj menu na urządzeniach mobilnych
3. Dodaj JavaScript do pokazywania/ukrywania menu
4. Przetestuj na różnych rozdzielczościach

**Poziom trudności:** ⭐⭐

---

### ZADANIE 13: Licznik znaków

**Gdzie:** `pages/add-entry.php` + JavaScript

**Co zrobić:**
1. Dodaj element pokazujący liczbę znaków
2. W JavaScript dodaj event listener na `input`
3. Aktualizuj licznik w czasie rzeczywistym
4. Zmień kolor gdy zbliża się limit

**Poziom trudności:** ⭐

---

### ZADANIE 14: Infinite scroll

**Gdzie:** `index.php` + `js/ajax-handlers.js`

**Co zrobić:**
1. Wykryj gdy użytkownik scrolluje do dołu strony
2. Automatycznie załaduj następną stronę wpisów przez AJAX
3. Dodaj wskaźnik ładowania
4. Zatrzymaj gdy nie ma więcej wpisów

**Poziom trudności:** ⭐⭐⭐

---

## Jak pracować z zadaniami?

### Krok 1: Przeczytaj zadanie
- Zrozum co masz zrobić
- Zobacz wskazówki w kodzie

### Krok 2: Znajdź miejsce w kodzie
- Otwórz odpowiedni plik
- Znajdź komentarz `TODO DLA UCZNIA`

### Krok 3: Zaimplementuj rozwiązanie
- Napisz kod według wskazówek
- Używaj przykładów z innych części projektu

### Krok 4: Przetestuj
- Sprawdź czy działa w przeglądarce
- Testuj różne scenariusze (błędne dane, puste pola, itp.)

### Krok 5: Debuguj
- Użyj `console.log()` w JavaScript
- Użyj `var_dump()` lub `echo` w PHP
- Sprawdź DevTools (F12) w przeglądarce

---

## Potrzebujesz pomocy?

1. Przeczytaj komentarze w kodzie
2. Zobacz plik `ROZWIAZANIA.md` (tylko po próbie samodzielnego rozwiązania!)
3. Użyj Google do wyszukania przykładów
4. Sprawdź dokumentację:
   - PHP: https://www.php.net/manual/pl/
   - JavaScript: https://developer.mozilla.org/pl/

---

**Powodzenia! Samodzielna implementacja to najlepsza nauka! 🚀**
