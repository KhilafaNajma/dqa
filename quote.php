<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Detail - Anonymous Quotes</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/particles.css">
</head>
<body>
    <?php include 'includes/background.php'; ?>
    <?php include 'includes/header.php'; ?>

    <main>
        <?php
        require_once 'config.php';
        
        if(isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            try {
                $stmt = $pdo->prepare("SELECT * FROM quotes WHERE id = ?");
                $stmt->execute([$id]);
                $quote = $stmt->fetch(PDO::FETCH_ASSOC);

                if($quote) {
                    ?>
                    <div class="quote-detail">
                        <div class="quote-card expanded">
                            <div class="quote-text">"<?php echo htmlspecialchars($quote['quote_text']); ?>"</div>
                            <div class="quote-author">- <?php echo htmlspecialchars($quote['author']); ?></div>
                            <div class="quote-date"><?php echo date('d M Y H:i', strtotime($quote['created_at'])); ?></div>
                        </div>

                        <div class="tab-container">
                            <div class="tab-buttons">
                                <button class="tab-button active" data-tab="quote">Quote</button>
                                <button class="tab-button" data-tab="comments">Komentar</button>
                            </div>
                            
                            <div class="tab-content">
                                <div id="quote" class="tab-pane active">
                                    <div class="quote-info">
                                        <p class="quote-description">
                                            Quote ini dibagikan oleh <?php echo htmlspecialchars($quote['author']); ?> 
                                            pada <?php echo date('d M Y H:i', strtotime($quote['created_at'])); ?>
                                        </p>
                                        
                                        <?php if (!empty($quote['description'])): ?>
                                        <div class="quote-story">
                                            <h3>Cerita di Balik Quote Ini:</h3>
                                            <p><?php echo nl2br(htmlspecialchars($quote['description'])); ?></p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div id="comments" class="tab-pane">
                                    <div id="disqus_thread"></div>
                                    <script>
                                        var disqus_config = function () {
                                            this.page.url = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';
                                            this.page.identifier = 'quote_<?php echo $id; ?>';
                                        };
                                        function loadDisqus() {
                                            var d = document, s = d.createElement('script');
                                            s.src = 'https://anonquote.disqus.com/embed.js';
                                            s.setAttribute('data-timestamp', +new Date());
                                            (d.head || d.body).appendChild(s);
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>

                        <a href="index.php" class="back-button">Kembali ke Home</a>
                    </div>
                    <?php
                } else {
                    echo '<div class="message error">Quote tidak ditemukan.</div>';
                }
            } catch(PDOException $e) {
                echo '<div class="error">Terjadi kesalahan. Silakan coba lagi nanti.</div>';
            }
        } else {
            echo '<div class="message error">ID Quote tidak valid.</div>';
        }
        ?>
    </main>

    <script src="js/particles.js"></script>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanes = document.querySelectorAll('.tab-pane');
            let disqusLoaded = false;

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and panes
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabPanes.forEach(pane => pane.classList.remove('active'));

                    // Add active class to clicked button and corresponding pane
                    button.classList.add('active');
                    const tabId = button.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');

                    // Load Disqus when comments tab is clicked
                    if (tabId === 'comments' && !disqusLoaded) {
                        loadDisqus();
                        disqusLoaded = true;
                    }
                });
            });
        });
    </script>
</body>
</html> 