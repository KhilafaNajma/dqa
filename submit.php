<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Quote - Anonymous Quotes</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/particles.css">
</head>
<body>
    <?php include 'includes/background.php'; ?>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="quote-form">
            <h2>Submit Your Quote</h2>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require_once 'config.php';
                
                $quote = trim($_POST['quote']);
                $author = !empty($_POST['author']) ? trim($_POST['author']) : 'Anonymous';
                $description = !empty($_POST['description']) ? trim($_POST['description']) : null;
                
                if (!empty($quote)) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO quotes (quote_text, author, description) VALUES (?, ?, ?)");
                        $stmt->execute([$quote, $author, $description]);
                        // Tampilkan pesan sukses di halaman yang sama
                        echo '<div class="message success">Quote berhasil ditambahkan! Silakan tambah quote lainnya.</div>';
                    } catch(PDOException $e) {
                        echo '<div class="message error">Maaf, terjadi kesalahan saat menyimpan quote. Silakan coba lagi.</div>';
                    }
                } else {
                    echo '<div class="message error">Quote tidak boleh kosong! Silakan isi quote Anda.</div>';
                }
            }
            ?>
            <form method="POST" action="/DQA/submit.php">
                <div class="form-group">
                    <textarea name="quote" id="quote" placeholder="Tulis quote mu di sini..." required></textarea>
                </div>

                <div class="form-group">
                    <textarea name="description" id="description" placeholder="Tambahkan deskripsi atau cerita di balik quote ini..."></textarea>
                </div>

                <div class="form-group">
                    <input type="text" name="author" id="author" placeholder="Nama">
                </div>

                <button type="submit">Submit Quote</button>
            </form>
        </div>
    </main>

    <script src="js/particles.js"></script>
    <script src="script.js"></script>
</body>
</html> 