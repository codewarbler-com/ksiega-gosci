<?php
/**
 * STRONA GŁÓWNA - Księga Gości
 * Wyświetla listę wpisów
 */

define('APP_ACCESS', true);
require_once 'config.php';
require_once 'php/functions.php';
require_once 'php/db-connection.php';

initSession();

// Pobierz wszystkie kategorie dla filtra
$db = getDB();
$stmt = $db->query("SELECT * FROM categories ORDER BY name");
$categories = $stmt->fetchAll();

// Paginacja i filtrowanie
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$offset = ($page - 1) * ENTRIES_PER_PAGE;

// Zapytanie SQL z filtrowaniem
$sql = "SELECT e.*, u.username, u.full_name, c.name AS category_name, c.color AS category_color
        FROM entries e
        INNER JOIN users u ON e.user_id = u.id
        LEFT JOIN categories c ON e.category_id = c.id
        WHERE e.is_approved = 1";

if ($category_filter > 0) {
    $sql .= " AND e.category_id = :category_id";
}

$sql .= " ORDER BY e.created_at DESC LIMIT :limit OFFSET :offset";

$stmt = $db->prepare($sql);
if ($category_filter > 0) {
    $stmt->bindValue(':category_id', $category_filter, PDO::PARAM_INT);
}
$stmt->bindValue(':limit', ENTRIES_PER_PAGE, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$entries = $stmt->fetchAll();

// Liczba wszystkich wpisów (dla paginacji)
$count_sql = "SELECT COUNT(*) FROM entries WHERE is_approved = 1";
if ($category_filter > 0) {
    $count_sql .= " AND category_id = :category_id";
    $count_stmt = $db->prepare($count_sql);
    $count_stmt->bindValue(':category_id', $category_filter, PDO::PARAM_INT);
    $count_stmt->execute();
    $total_entries = $count_stmt->fetchColumn();
} else {
    $total_entries = $db->query($count_sql)->fetchColumn();
}

$total_pages = ceil($total_entries / ENTRIES_PER_PAGE);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Strona Główna</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Nawigacja -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h1><?php echo APP_NAME; ?></h1>
            </div>
            <div class="nav-menu">
                <a href="index.php" class="nav-link active">Strona Główna</a>
                <?php if (isLoggedIn()): ?>
                    <a href="pages/dashboard.php" class="nav-link">Panel użytkownika</a>
                    <a href="pages/add-entry.php" class="nav-link">Dodaj wpis</a>
                    <a href="php/logout.php" class="nav-link">Wyloguj (<?php echo escapeHTML($_SESSION['username']); ?>)</a>
                <?php else: ?>
                    <a href="pages/login.php" class="nav-link">Logowanie</a>
                    <a href="pages/register.php" class="nav-link">Rejestracja</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Flash Message -->
    <?php
    $flash = getFlashMessage();
    if ($flash):
    ?>
        <div class="alert alert-<?php echo $flash['type']; ?>">
            <div class="container">
                <?php echo escapeHTML($flash['message']); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Główna treść -->
    <main class="container">
        <!-- Hero Section -->
        <section class="hero">
            <h2>Witaj w Księdze Gości!</h2>
            <p>Podziel się swoimi wrażeniami, pytaniami lub sugestiami.</p>
            <?php if (!isLoggedIn()): ?>
                <a href="pages/register.php" class="btn btn-primary">Zarejestruj się i dodaj wpis</a>
            <?php else: ?>
                <a href="pages/add-entry.php" class="btn btn-primary">Dodaj nowy wpis</a>
            <?php endif; ?>
        </section>

        <!-- Filtry -->
        <section class="filters">
            <form method="GET" action="index.php" class="filter-form">
                <label for="category">Filtruj po kategorii:</label>
                <select name="category" id="category" onchange="this.form.submit()">
                    <option value="0">Wszystkie kategorie</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo $category_filter == $cat['id'] ? 'selected' : ''; ?>>
                            <?php echo escapeHTML($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </section>

        <!-- Lista wpisów -->
        <section class="entries">
            <h3>Wpisy w księdze (<?php echo $total_entries; ?>)</h3>

            <?php if (empty($entries)): ?>
                <div class="no-entries">
                    <p>Brak wpisów do wyświetlenia.</p>
                    <?php if (isLoggedIn()): ?>
                        <a href="pages/add-entry.php" class="btn btn-secondary">Dodaj pierwszy wpis!</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <?php foreach ($entries as $entry): ?>
                    <article class="entry-card">
                        <div class="entry-header">
                            <div class="entry-author">
                                <strong><?php echo escapeHTML($entry['full_name']); ?></strong>
                                <span class="entry-username">(@<?php echo escapeHTML($entry['username']); ?>)</span>
                            </div>
                            <div class="entry-meta">
                                <?php if ($entry['category_name']): ?>
                                    <span class="badge" style="background-color: <?php echo escapeHTML($entry['category_color']); ?>">
                                        <?php echo escapeHTML($entry['category_name']); ?>
                                    </span>
                                <?php endif; ?>
                                <span class="entry-date"><?php echo formatDate($entry['created_at']); ?></span>
                            </div>
                        </div>
                        <div class="entry-body">
                            <h4 class="entry-title"><?php echo escapeHTML($entry['title']); ?></h4>
                            <p class="entry-content"><?php echo nl2br(escapeHTML($entry['content'])); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <!-- Paginacja -->
        <?php if ($total_pages > 1): ?>
            <nav class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>&category=<?php echo $category_filter; ?>" class="btn btn-secondary">Poprzednia</a>
                <?php endif; ?>

                <span class="page-info">Strona <?php echo $page; ?> z <?php echo $total_pages; ?></span>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&category=<?php echo $category_filter; ?>" class="btn btn-secondary">Następna</a>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </main>

    <!-- Stopka -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 <?php echo APP_NAME; ?>. Projekt edukacyjny INF.03.</p>
            <p>Wersja <?php echo APP_VERSION; ?></p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
