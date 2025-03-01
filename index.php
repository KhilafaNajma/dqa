<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Quotes</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/particles.css">
</head>
<body>
    <?php include 'includes/background.php'; ?>
    <?php include 'includes/header.php'; ?>

    <main>
        <h1>Welcome to Anonymous Quotes!</h1>
        <p>Share or read quotes without revealing your identity.</p>

        <div class="quote-container">
            <?php
            require_once 'config.php';
            try {
                $stmt = $pdo->query("SELECT * FROM quotes ORDER BY created_at DESC");
                
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        include 'includes/quote-card.php';
                    }
                } else {
                    echo '<div class="message info">Belum ada quote yang ditambahkan. Jadilah yang pertama!</div>';
                }
            } catch(PDOException $e) {
                echo '<div class="error">Terjadi kesalahan. Silakan coba lagi nanti.</div>';
            }
            ?>
        </div>
    </main>

    <script src="js/particles.js"></script>
    <script src="script.js"></script>
</body>
</html> 