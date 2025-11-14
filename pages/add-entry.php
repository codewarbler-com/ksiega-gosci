<?php
/**
 * DODAWANIE WPISU
 * Formularz dodawania nowego wpisu do księgi gości
 */

define('APP_ACCESS', true);
require_once '../config.php';
require_once '../php/functions.php';
require_once '../php/db-connection.php';

initSession();

// Wymagaj zalogowania
requireLogin('login.php');

$db = getDB();

// Pobierz kategorie dla selecta
$stmt = $db->query("SELECT * FROM categories ORDER BY name");
$categories = $stmt->fetchAll();

// Obsługa formularza
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Weryfikacja tokenu CSRF
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Nieprawidłowy token bezpieczeństwa';
    } else {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $category_id = (int)($_POST['category_id'] ?? 0);

        // Walidacja po stronie serwera
        if (empty($title)) {
            $errors[] = 'Tytuł jest wymagany';
        } elseif (strlen($title) < 5) {
            $errors[] = 'Tytuł musi mieć minimum 5 znaków';
        } elseif (strlen($title) > MAX_TITLE_LENGTH) {
            $errors[] = 'Tytuł może mieć maksymalnie ' . MAX_TITLE_LENGTH . ' znaków';
        }

        if (empty($content)) {
            $errors[] = 'Treść wpisu jest wymagana';
        } elseif (strlen($content) < 10) {
            $errors[] = 'Treść musi mieć minimum 10 znaków';
        } elseif (strlen($content) > MAX_CONTENT_LENGTH) {
            $errors[] = 'Treść może mieć maksymalnie ' . MAX_CONTENT_LENGTH . ' znaków';
        }

        // Sprawdź czy kategoria istnieje (jeśli wybrano)
        if ($category_id > 0) {
            $stmt = $db->prepare("SELECT id FROM categories WHERE id = ?");
            $stmt->execute([$category_id]);
            if (!$stmt->fetch()) {
                $errors[] = 'Wybrana kategoria nie istnieje';
                $category_id = null;
            }
        } else {
            $category_id = null;
        }

        // ====================================
        // TODO DLA UCZNIA - ZADANIE 6
        // ====================================
        // Uzupełnij kod dodawania wpisu do bazy danych
        //
        // 1. Pobierz adres IP użytkownika używając getUserIP()
        // 2. Przygotuj zapytanie SQL INSERT do tabeli entries:
        //    - user_id (z sesji: $_SESSION['user_id'])
        //    - category_id (może być NULL)
        //    - title
        //    - content
        //    - ip_address
        // 3. Użyj prepared statement ($db->prepare())
        // 4. Wykonaj zapytanie ($stmt->execute())
        // 5. Jeśli sukces:
        //    - Użyj setFlashMessage('Wpis został dodany!', 'success')
        //    - Przekieruj na index.php używając redirect()
        // 6. Jeśli błąd:
        //    - Dodaj błąd do tablicy $errors

        // TWÓJ KOD TUTAJ:
        if (empty($errors)) {
            $user_id = $_SESSION['user_id'];
            $ip_address = getUserIP();

            try {
                // Przygotuj zapytanie INSERT
                // $stmt = $db->prepare("INSERT INTO entries ...");
                // $stmt->execute([...]);

                // Jeśli sukces:
                // setFlashMessage('...', 'success');
                // redirect('../index.php');

                // TYMCZASOWO - usuń po implementacji:
                $errors[] = 'ZADANIE DLA UCZNIA: Dokończ implementację dodawania wpisu (ZADANIE 6 w add-entry.php)';

            } catch (PDOException $e) {
                if (DEBUG_MODE) {
                    $errors[] = 'Błąd bazy danych: ' . $e->getMessage();
                } else {
                    $errors[] = 'Wystąpił błąd podczas dodawania wpisu. Spróbuj ponownie.';
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj wpis - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h1><a href="../index.php"><?php echo APP_NAME; ?></a></h1>
            </div>
            <div class="nav-menu">
                <a href="../index.php" class="nav-link">Strona Główna</a>
                <a href="dashboard.php" class="nav-link">Panel użytkownika</a>
                <a href="add-entry.php" class="nav-link active">Dodaj wpis</a>
                <a href="../php/logout.php" class="nav-link">Wyloguj</a>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="form-container">
            <h2>Dodaj nowy wpis</h2>
            <p>Podziel się swoimi przemyśleniami w Księdze Gości</p>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo escapeHTML($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="add-entry.php" onsubmit="return validateEntryForm(event)">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <div class="form-group">
                    <label for="category_id">Kategoria (opcjonalna)</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="0">-- Wybierz kategorię --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"
                                <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo escapeHTML($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Tytuł wpisu *</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        value="<?php echo escapeHTML($_POST['title'] ?? ''); ?>"
                        maxlength="<?php echo MAX_TITLE_LENGTH; ?>"
                        required
                    >
                    <small style="color: #6c757d;">Min. 5 znaków, max. <?php echo MAX_TITLE_LENGTH; ?> znaków</small>
                    <div id="title-error" class="form-error"></div>
                </div>

                <div class="form-group">
                    <label for="content">Treść wpisu *</label>
                    <textarea
                        id="content"
                        name="content"
                        class="form-control"
                        rows="8"
                        maxlength="<?php echo MAX_CONTENT_LENGTH; ?>"
                        required
                    ><?php echo escapeHTML($_POST['content'] ?? ''); ?></textarea>
                    <small style="color: #6c757d;">Min. 10 znaków, max. <?php echo MAX_CONTENT_LENGTH; ?> znaków</small>
                    <div id="content-error" class="form-error"></div>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Dodaj wpis</button>
            </form>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 <?php echo APP_NAME; ?>. Projekt edukacyjny INF.03.</p>
        </div>
    </footer>

    <script src="../js/main.js"></script>
    <script src="../js/validation.js"></script>
</body>
</html>
