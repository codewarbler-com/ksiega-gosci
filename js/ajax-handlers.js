/**
 * OBSŁUGA AJAX
 * Księga Gości - Projekt INF.03
 *
 * Funkcje do komunikacji z serwerem bez przeładowania strony
 */

/**
 * Załaduj wpisy dynamicznie (AJAX)
 * Używane do odświeżania listy wpisów bez przeładowania strony
 *
 * @param {number} page - Numer strony
 * @param {number} categoryId - ID kategorii (0 = wszystkie)
 */
function loadEntries(page = 1, categoryId = 0) {
    // Pokaż loading indicator
    showLoadingIndicator();

    // ====================================
    // TODO DLA UCZNIA - ZADANIE 4
    // ====================================
    // Uzupełnij zapytanie AJAX używając Fetch API
    //
    // 1. Utwórz URL do php/api-handler.php z parametrami:
    //    - action=get_entries
    //    - page=wartość parametru page
    //    - category=wartość parametru categoryId
    //    Przykład: 'php/api-handler.php?action=get_entries&page=1&category=0'
    //
    // 2. Użyj fetch() do wysłania zapytania GET
    //
    // 3. Sprawdź czy odpowiedź jest OK (response.ok)
    //
    // 4. Przekształć odpowiedź do JSON (response.json())
    //
    // 5. Wywołaj displayEntries(data.entries) jeśli data.success === true
    //
    // 6. Obsłuż błędy w catch()

    // TWÓJ KOD TUTAJ:
    const url = `php/api-handler.php?action=get_entries&page=${page}&category=${categoryId}`;

    fetch(url)
        .then(response => {
            // Sprawdź odpowiedź...
        })
        .then(data => {
            // Przetwórz dane...
        })
        .catch(error => {
            console.error('Błąd AJAX:', error);
            hideLoadingIndicator();
            alert('Wystąpił błąd podczas ładowania wpisów');
        });
}

/**
 * Wyświetl wpisy na stronie
 *
 * @param {Array} entries - Tablica wpisów z serwera
 */
function displayEntries(entries) {
    const container = document.getElementById('entries-container');

    if (!container) {
        console.error('Brak kontenera #entries-container');
        return;
    }

    // Wyczyść kontener
    container.innerHTML = '';

    if (entries.length === 0) {
        container.innerHTML = `
            <div class="no-entries">
                <p>Brak wpisów do wyświetlenia.</p>
            </div>
        `;
        hideLoadingIndicator();
        return;
    }

    // Dodaj każdy wpis
    entries.forEach(entry => {
        const entryCard = createEntryCard(entry);
        container.appendChild(entryCard);
    });

    hideLoadingIndicator();
}

/**
 * Utwórz element karty wpisu
 *
 * @param {Object} entry - Obiekt wpisu
 * @returns {HTMLElement} - Element karty wpisu
 */
function createEntryCard(entry) {
    const article = document.createElement('article');
    article.className = 'entry-card';

    const categoryBadge = entry.category_name
        ? `<span class="badge" style="background-color: ${escapeHtml(entry.category_color)}">
               ${escapeHtml(entry.category_name)}
           </span>`
        : '';

    article.innerHTML = `
        <div class="entry-header">
            <div class="entry-author">
                <strong>${escapeHtml(entry.full_name)}</strong>
                <span class="entry-username">(@${escapeHtml(entry.username)})</span>
            </div>
            <div class="entry-meta">
                ${categoryBadge}
                <span class="entry-date">${escapeHtml(entry.formatted_date)}</span>
            </div>
        </div>
        <div class="entry-body">
            <h4 class="entry-title">${escapeHtml(entry.title)}</h4>
            <p class="entry-content">${escapeHtml(entry.content).replace(/\n/g, '<br>')}</p>
        </div>
    `;

    return article;
}

/**
 * Usuń wpis (AJAX)
 * Używane przez moderatorów/adminów
 *
 * @param {number} entryId - ID wpisu do usunięcia
 */
function deleteEntry(entryId) {
    if (!confirm('Czy na pewno chcesz usunąć ten wpis?')) {
        return;
    }

    // ====================================
    // TODO DLA UCZNIA - ZADANIE 5 (ROZSZERZAJĄCE)
    // ====================================
    // Zaimplementuj usuwanie wpisu przez AJAX
    //
    // 1. Utwórz obiekt FormData z:
    //    - action: 'delete_entry'
    //    - entry_id: entryId
    //    - csrf_token: pobierz z meta tagu lub hidden input
    //
    // 2. Użyj fetch() z metodą POST
    //
    // 3. Prześlij FormData jako body
    //
    // 4. Po sukcesie, odśwież listę wpisów (loadEntries())
    //
    // 5. Pokaż komunikat sukcesu/błędu

    // TWÓJ KOD TUTAJ:
    console.log('Usuwanie wpisu ID:', entryId);
    alert('Funkcja deleteEntry() wymaga implementacji (ZADANIE 5)');
}

/**
 * Pokaż wskaźnik ładowania
 */
function showLoadingIndicator() {
    const loader = document.getElementById('loading-indicator');
    if (loader) {
        loader.style.display = 'block';
    } else {
        // Utwórz loader jeśli nie istnieje
        const div = document.createElement('div');
        div.id = 'loading-indicator';
        div.className = 'loading-indicator';
        div.innerHTML = '<p>Ładowanie...</p>';
        document.body.appendChild(div);
    }
}

/**
 * Ukryj wskaźnik ładowania
 */
function hideLoadingIndicator() {
    const loader = document.getElementById('loading-indicator');
    if (loader) {
        loader.style.display = 'none';
    }
}

/**
 * Escape HTML - zabezpieczenie przed XSS
 *
 * @param {string} text - Tekst do escape
 * @returns {string} - Bezpieczny tekst
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

/**
 * Pobierz token CSRF z meta tagu
 *
 * @returns {string|null} - Token CSRF lub null
 */
function getCSRFToken() {
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    return metaTag ? metaTag.getAttribute('content') : null;
}

// ============================================
// Inicjalizacja po załadowaniu DOM
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Dodaj event listenery dla przycisków AJAX (jeśli istnieją)

    // Przykład: Przycisk "Załaduj więcej"
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const nextPage = parseInt(this.dataset.page) || 1;
            loadEntries(nextPage);
            this.dataset.page = nextPage + 1;
        });
    }

    // Przykład: Filtrowanie kategorii bez przeładowania
    const categorySelect = document.getElementById('category-filter-ajax');
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            const categoryId = parseInt(this.value) || 0;
            loadEntries(1, categoryId);
        });
    }
});

// ============================================
// INFORMACJE DLA UCZNIA
// ============================================

/*
WYJAŚNIENIE AJAX i Fetch API:

1. AJAX (Asynchronous JavaScript and XML)
   - Komunikacja z serwerem bez przeładowania strony
   - Nowoczesna metoda: Fetch API
   - Starsza metoda: XMLHttpRequest

2. Fetch API
   fetch(url)
       .then(response => response.json())
       .then(data => { /* użyj danych }
       .catch(error => { /* obsłuż błąd });

3. Metody HTTP
   - GET: Pobieranie danych (domyślna)
   - POST: Wysyłanie danych
   - PUT: Aktualizacja danych
   - DELETE: Usuwanie danych

4. Promises (.then / .catch)
   - Asynchroniczne operacje
   - .then() - gdy sukces
   - .catch() - gdy błąd
   - Można łączyć w łańcuch

5. JSON
   - JavaScript Object Notation
   - Format wymiany danych
   - response.json() - parsowanie JSON
   - JSON.stringify() - obiekt -> string

6. FormData
   - Obiekt do wysyłania formularzy przez AJAX
   - const formData = new FormData();
   - formData.append('key', 'value');

PRZYKŁAD UŻYCIA:

// Proste zapytanie GET
fetch('api.php?action=get_data')
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));

// Zapytanie POST z danymi
const formData = new FormData();
formData.append('action', 'save_data');
formData.append('value', '123');

fetch('api.php', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        alert('Sukces!');
    }
});

ZADANIA DO WYKONANIA:
1. Uzupełnij funkcję loadEntries() (ZADANIE 4)
2. (Opcjonalnie) Zaimplementuj deleteEntry() (ZADANIE 5)

WSKAZÓWKI:
- Sprawdź dokumentację Fetch API
- Użyj console.log() do debugowania
- Sprawdź Network tab w DevTools
- Pamiętaj o obsłudze błędów

ZADANIE ROZSZERZAJĄCE:
- Dodaj loading spinner CSS
- Zaimplementuj infinite scroll
- Dodaj debouncing do wyszukiwania
- Zaimplementuj edycję wpisu przez AJAX
*/
