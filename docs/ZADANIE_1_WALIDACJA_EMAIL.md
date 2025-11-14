# ZADANIE 1: Walidacja Email - Kompletny Przewodnik

> Szczegółowe wytłumaczenie zadania walidacji adresu email w JavaScript

---

## Spis treści

1. [Wprowadzenie](#wprowadzenie)
2. [Dlaczego walidujemy email?](#dlaczego-walidujemy-email)
3. [Teoria - Jak działa walidacja](#teoria)
4. [Wyrażenia regularne (RegEx)](#wyrazenia-regularne)
5. [Instrukcja krok po kroku](#instrukcja-krok-po-kroku)
6. [Przykłady kodu](#przyklady-kodu)
7. [Testowanie](#testowanie)
8. [Typowe błędy](#typowe-bledy)
9. [Zadania dodatkowe](#zadania-dodatkowe)

---

## Wprowadzenie

### Co to jest ZADANIE 1?

W projekcie "Księga Gości" Twoim zadaniem jest **dokończenie funkcji walidującej adres email** w formularzu rejestracji.

**Lokalizacja:** `js/validation.js` (około linia 55)

**Funkcja:** `validateRegistrationForm(event)`

**Co musisz zrobić:**
1. Sprawdzić czy pole email nie jest puste
2. Sprawdzić czy email ma poprawny format
3. Wyświetlić odpowiedni komunikat błędu jeśli walidacja nie przejdzie

---

## Dlaczego walidujemy email?

### 1. Doświadczenie użytkownika (UX)
- ✅ Natychmiastowa informacja zwrotna
- ✅ Użytkownik od razu wie co poprawić
- ✅ Nie musi czekać na odpowiedź serwera

### 2. Zmniejszenie ruchu sieciowego
- ✅ Nie wysyłamy niepoprawnych danych do serwera
- ✅ Oszczędzamy zasoby serwera
- ✅ Przyspiesza działanie aplikacji

### 3. Zgodność z wymaganiami egzaminu INF.03
- ✅ Walidacja po stronie klienta (JavaScript) - **wymagane**
- ✅ Użycie wyrażeń regularnych - **wymagane**
- ✅ Obsługa zdarzeń formularza - **wymagane**

### ⚠️ WAŻNE: Walidacja po stronie klienta NIE ZASTĘPUJE walidacji po stronie serwera!

**Dlaczego?**
- Użytkownik może wyłączyć JavaScript
- Ktoś może wysłać dane bezpośrednio do API
- JavaScript można ominąć przez DevTools

**Dobre praktyki:**
- Waliduj ZAWSZE po stronie klienta (JavaScript) - dla UX
- Waliduj ZAWSZE po stronie serwera (PHP) - dla bezpieczeństwa

---

## Teoria

### Jak działa walidacja formularza?

```
1. Użytkownik wypełnia formularz
   ↓
2. Użytkownik klika "Zarejestruj się"
   ↓
3. Wydarzenie 'submit' jest wywoływane
   ↓
4. JavaScript przechwytuje wydarzenie (event.preventDefault())
   ↓
5. Funkcja walidująca sprawdza wszystkie pola
   ↓
6. Jeśli OK → formularz zostaje wysłany (form.submit())
   ↓
7. Jeśli błąd → pokazuje komunikat błędu, NIE wysyła formularza
```

### event.preventDefault()

**Co to robi?**
- Zatrzymuje domyślne działanie formularza (wysłanie)
- Daje nam kontrolę nad walidacją
- Pozwala sprawdzić dane przed wysłaniem

**Przykład:**
```javascript
function validateRegistrationForm(event) {
    event.preventDefault(); // STOP! Nie wysyłaj jeszcze formularza!

    // Teraz możemy sprawdzić dane...

    // Jeśli OK:
    form.submit(); // Teraz wysyłamy
}
```

---

## Wyrażenia regularne

### Co to jest RegEx (Regular Expression)?

**Wyrażenie regularne** to wzorzec opisujący format tekstu.

**Przykłady:**
- `/^[0-9]+$/` - tylko cyfry
- `/^[a-z]+$/` - tylko małe litery
- `/^[a-zA-Z0-9]+$/` - litery i cyfry

### RegEx dla adresu email

```javascript
/^[^\s@]+@[^\s@]+\.[^\s@]+$/
```

**Rozłóżmy to na części:**

#### 1. Znaki specjalne

| Symbol | Znaczenie |
|--------|-----------|
| `^` | Początek stringa |
| `$` | Koniec stringa |
| `.` | Dowolny znak (normalnie) |
| `\.` | Kropka (dosłownie) |
| `+` | Jeden lub więcej |
| `[]` | Zestaw znaków |
| `[^]` | Negacja (wszystko OPRÓCZ) |

#### 2. Schemat email

```
nazwa@domena.rozszerzenie
```

#### 3. Analiza wzorca

```javascript
/^[^\s@]+@[^\s@]+\.[^\s@]+$/
```

**Część 1:** `^[^\s@]+`
- `^` - od początku stringa
- `[^\s@]` - dowolny znak OPRÓCZ spacji (`\s`) i `@`
- `+` - jeden lub więcej takich znaków
- **Znaczenie:** "nazwa" przed @

**Część 2:** `@`
- Dosłownie znak `@`

**Część 3:** `[^\s@]+`
- `[^\s@]` - dowolny znak OPRÓCZ spacji i `@`
- `+` - jeden lub więcej
- **Znaczenie:** "domena" po @

**Część 4:** `\.`
- `\.` - dosłownie kropka
- (bez backslash `.` oznaczałoby "dowolny znak")

**Część 5:** `[^\s@]+$`
- `[^\s@]` - dowolny znak OPRÓCZ spacji i `@`
- `+` - jeden lub więcej
- `$` - do końca stringa
- **Znaczenie:** "rozszerzenie" (.pl, .com, etc.)

### Przykłady - co pasuje, co nie?

✅ **PASUJE:**
```
jan@example.com
anna.nowak@firma.pl
test123@test-domain.co.uk
user+tag@gmail.com
```

❌ **NIE PASUJE:**
```
jan                    (brak @)
jan@                   (brak domeny)
@example.com           (brak nazwy)
jan@example            (brak kropki i rozszerzenia)
jan kowalski@test.com  (spacja)
jan@@test.com          (podwójny @)
```

### Testowanie RegEx

**Metoda `.test()`**

```javascript
const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

regex.test('jan@example.com');      // true - pasuje
regex.test('nieprawidlowy');        // false - nie pasuje
regex.test('jan@');                 // false - nie pasuje
```

**Jak to działa:**
1. `.test()` porównuje string z wzorcem
2. Zwraca `true` jeśli pasuje
3. Zwraca `false` jeśli nie pasuje

---

## Instrukcja krok po kroku

### Krok 1: Otwórz plik

Otwórz plik: `js/validation.js`

Znajdź linię około 55:

```javascript
// ====================================
// TODO DLA UCZNIA - ZADANIE 1
// ====================================
```

### Krok 2: Zrozum kontekst

Przed TODO jest już walidacja username:

```javascript
// WALIDACJA USERNAME
if (username === '') {
    showError('Nazwa użytkownika jest wymagana', 'username-error');
    isValid = false;
} else if (username.length < 3) {
    showError('Nazwa użytkownika musi mieć minimum 3 znaki', 'username-error');
    isValid = false;
}
```

**Struktura:**
1. Sprawdź warunek (`if`)
2. Jeśli błąd → pokaż komunikat (`showError`)
3. Ustaw `isValid = false`

### Krok 3: Napisz kod walidacji email

**Wersja podstawowa:**

```javascript
// WALIDACJA EMAIL
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
}
```

**Wyjaśnienie:**
- `email === ''` - sprawdza czy email jest pusty
- `showError(...)` - wyświetla komunikat błędu
- `'email-error'` - ID elementu gdzie wyświetlić błąd
- `isValid = false` - oznacza że formularz ma błąd

### Krok 4: Dodaj walidację formatu

```javascript
// WALIDACJA EMAIL
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
} else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

**Wyjaśnienie:**
- `!/.../.test(email)` - wykrzyknik `!` oznacza negację
- Jeśli email NIE pasuje do wzorca → błąd
- `else if` - sprawdza tylko jeśli email nie jest pusty

### Krok 5: Zapisz plik

Zapisz plik (Ctrl+S lub Cmd+S)

### Krok 6: Przetestuj

Otwórz `pages/register.php` w przeglądarce i przetestuj!

---

## Przykłady kodu

### Przykład 1: Minimalna wersja

```javascript
// WALIDACJA EMAIL
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
} else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

### Przykład 2: Z komentarzami (zalecane dla nauki)

```javascript
// ====================================
// WALIDACJA EMAIL
// ====================================

// Sprawdź czy pole nie jest puste
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
}
// Sprawdź format email używając RegEx
else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

### Przykład 3: Z wydzieloną zmienną RegEx

```javascript
// WALIDACJA EMAIL
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
} else if (!emailRegex.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

### Przykład 4: Zaawansowany (z dodatkowymi sprawdzeniami)

```javascript
// WALIDACJA EMAIL
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
} else if (email.length > 100) {
    showError('Email jest za długi (max 100 znaków)', 'email-error');
    isValid = false;
} else if (!emailRegex.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

---

## Testowanie

### Test 1: Puste pole

1. Otwórz `pages/register.php`
2. NIE wpisuj email
3. Wypełnij pozostałe pola
4. Kliknij "Zarejestruj się"

**Oczekiwany rezultat:**
- ❌ Formularz NIE zostaje wysłany
- ✅ Pokazuje się komunikat: "Email jest wymagany"
- ✅ Komunikat jest **czerwony**

### Test 2: Nieprawidłowy format

Przetestuj z różnymi wartościami:

```javascript
// Test A: Brak @
Email: "jankowalski"
Oczekiwany błąd: "Nieprawidłowy format email"

// Test B: Brak domeny
Email: "jan@"
Oczekiwany błąd: "Nieprawidłowy format email"

// Test C: Brak rozszerzenia
Email: "jan@example"
Oczekiwany błąd: "Nieprawidłowy format email"

// Test D: Spacja w środku
Email: "jan kowalski@test.com"
Oczekiwany błąd: "Nieprawidłowy format email"
```

### Test 3: Poprawny email

```javascript
Email: "jan@example.com"
Wszystkie pozostałe pola: poprawne
```

**Oczekiwany rezultat:**
- ✅ Formularz zostaje wysłany
- ✅ Brak komunikatu błędu dla email
- ✅ Przekierowanie do strony logowania

### Test 4: DevTools - sprawdź konsolę

1. Otwórz DevTools (F12)
2. Przejdź do zakładki **Console**
3. Wypełnij formularz z błędnym emailem
4. Kliknij "Zarejestruj się"

**Sprawdź:**
- Czy nie ma błędów JavaScript (czerwone komunikaty)
- Możesz dodać `console.log('Email:', email);` dla debugowania

---

## Typowe błędy

### Błąd 1: Brak wykrzyknika `!` przed RegEx

❌ **ŹLE:**
```javascript
if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

✅ **DOBRZE:**
```javascript
if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

**Dlaczego?**
- Bez `!` sprawdzamy czy email **JEST** poprawny
- Z `!` sprawdzamy czy email **NIE JEST** poprawny
- Chcemy pokazać błąd gdy email NIE JEST poprawny!

### Błąd 2: Zły ID elementu błędu

❌ **ŹLE:**
```javascript
showError('Email jest wymagany', 'error-email');
```

✅ **DOBRZE:**
```javascript
showError('Email jest wymagany', 'email-error');
```

**Dlaczego?**
- W HTML element ma ID: `<div id="email-error"></div>`
- Musi się zgadzać!

### Błąd 3: Brak `isValid = false`

❌ **ŹLE:**
```javascript
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    // Brak isValid = false!
}
```

✅ **DOBRZE:**
```javascript
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
}
```

**Dlaczego?**
- Bez `isValid = false` formularz zostanie wysłany mimo błędu!

### Błąd 4: Błąd w RegEx (brak escape dla kropki)

❌ **ŹLE:**
```javascript
/^[^\s@]+@[^\s@]+.[^\s@]+$/  // kropka bez backslash
```

✅ **DOBRZE:**
```javascript
/^[^\s@]+@[^\s@]+\.[^\s@]+$/  // \.
```

**Dlaczego?**
- `.` bez `\` oznacza "dowolny znak"
- `\.` oznacza dosłownie kropkę

### Błąd 5: Używanie `==` zamiast `===`

⚠️ **Niezbyt dobrze:**
```javascript
if (email == '') { ... }
```

✅ **DOBRZE:**
```javascript
if (email === '') { ... }
```

**Dlaczego?**
- `===` sprawdza wartość I typ (strict equality)
- `==` tylko wartość (może dać niespodziewane rezultaty)
- Zawsze używaj `===` w JavaScript!

---

## Zadania dodatkowe

### Zadanie A: Dodaj walidację długości

Sprawdź czy email nie jest za długi (max 100 znaków):

```javascript
if (email === '') {
    showError('Email jest wymagany', 'email-error');
    isValid = false;
} else if (email.length > 100) {
    // TUTAJ: Dodaj komunikat o za długim email
} else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    showError('Nieprawidłowy format email', 'email-error');
    isValid = false;
}
```

### Zadanie B: Real-time walidacja

Dodaj walidację podczas wpisywania (nie tylko po kliknięciu przycisku):

```javascript
// Na końcu pliku validation.js:
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');

    if (emailInput) {
        emailInput.addEventListener('input', function() {
            const email = this.value.trim();

            // Tutaj dodaj walidację email
            // Pokaż komunikat błędu lub ukryj jeśli poprawny
        });
    }
});
```

### Zadanie C: Wizualna wskazówka

Dodaj zieloną ramkę gdy email jest poprawny:

```javascript
// W CSS dodaj:
.form-control.valid {
    border-color: #28a745;
}

// W JavaScript:
if (emailRegex.test(email)) {
    emailInput.classList.add('valid');
} else {
    emailInput.classList.remove('valid');
}
```

### Zadanie D: Zaawansowany RegEx

Użyj bardziej restrykcyjnego RegEx (akceptuje tylko popularne domeny):

```javascript
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|pl|org|net|edu)$/;
```

---

## Podsumowanie

### ✅ Co powinieneś umieć po tym zadaniu:

1. **Rozumieć walidację formularzy**
   - Dlaczego walidujemy
   - Jak działa `event.preventDefault()`
   - Kiedy używać walidacji po stronie klienta

2. **Wyrażenia regularne**
   - Co to jest RegEx
   - Jak działa wzorzec dla email
   - Metoda `.test()`

3. **JavaScript**
   - Instrukcje warunkowe (`if/else`)
   - Operatory logiczne (`!`, `===`)
   - Wywołania funkcji (`showError`)

4. **Debugowanie**
   - Testowanie różnych scenariuszy
   - Używanie DevTools
   - Znajdowanie i naprawianie błędów

### 📚 Materiały do dalszej nauki:

- **RegEx:** https://regexr.com/ (interaktywny tester)
- **JavaScript:** https://javascript.info/
- **Walidacja:** https://www.w3schools.com/js/js_validation.asp

### 🎯 Następny krok:

Po ukończeniu tego zadania przejdź do **ZADANIA 2: Walidacja hasła**

---

**Powodzenia! Pamiętaj - najlepsza nauka to praktyka! 💪**

_Jeśli utkniesz, zajrzyj do `ROZWIAZANIA.md` (ale tylko po próbie samodzielnego rozwiązania!)_
