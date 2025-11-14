<?php
/**
 * PANEL UŻYTKOWNIKA
 * Wyświetla wpisy użytkownika
 */

define('APP_ACCESS', true);
require_once '../config.php';
require_once '../php/functions.php';
require_once '../php/db-connection.php';

initSession();
requireLogin('login.php');

$db = getDB();
$user_id = $_SESSION['user_id'];

// Pobierz wpisy użytkownika
$stmt = $db->prepare("
    SELECT e.*, c.name AS category_name, c.color AS category_color
    FROM entries e
    LEFT JOIN categories c ON e.category_id = c.id
    WHERE e.user_id = ?
    ORDER BY e.created_at DESC
");
$stmt->execute([$user_id]);
$entries = $stmt->fetchAll();

// Statystyki
$stmt = $db->prepare("SELECT COUNT(*) FROM entries WHERE user_id = ?");
$stmt->execute([$user_id]);
$total_entries = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel użytkownika - <?php echo APP_NAME; ?></title>
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
                <a href="dashboard.php" class="nav-link active">Panel użytkownika</a>
                <a href="add-entry.php" class="nav-link">Dodaj wpis</a>
                <a href="../php/logout.php" class="nav-link">Wyloguj</a>
            </div>
        </div>
    </nav>

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

    <main class="container">
        <section class="hero">
            <h2>Witaj, <?php echo escapeHTML($_SESSION['full_name']); ?>!</h2>
            <p>Masz <?php echo $total_entries; ?> <?php echo $total_entries == 1 ? 'wpis' : 'wpisów'; ?> w księdze gości.</p>
            <a href="add-entry.php" class="btn btn-primary">Dodaj nowy wpis</a>
        </section>

        <section class="entries">
            <h3>Twoje wpisy</h3>

            <?php if (empty($entries)): ?>
                <div class="no-entries">
                    <p>Nie masz jeszcze żadnych wpisów.</p>
                    <a href="add-entry.php" class="btn btn-secondary">Dodaj pierwszy wpis!</a>
                </div>
            <?php else: ?>
                <?php foreach ($entries as $entry): ?>
                    <article class="entry-card">
                        <div class="entry-header">
                            <div class="entry-author">
                                <?php if ($entry['category_name']): ?>
                                    <span class="badge" style="background-color: <?php echo escapeHTML($entry['category_color']); ?>">
                                        <?php echo escapeHTML($entry['category_name']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="entry-meta">
                                <span class="entry-date"><?php echo formatDate($entry['created_at']); ?></span>
                                <?php if ($entry['is_approved']): ?>
                                    <span style="color: #28a745;">✓ Zatwierdzony</span>
                                <?php else: ?>
                                    <span style="color: #ffc107;">⏳ Oczekuje na zatwierdzenie</span>
                                <?php endif; ?>
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
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 <?php echo APP_NAME; ?>. Projekt edukacyjny INF.03.</p>
        </div>
    </footer>

    <script src="../js/main.js"></script>
</body>
</html>
