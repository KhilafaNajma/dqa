<a href="quote.php?id=<?php echo $row['id']; ?>" class="quote-link">
    <div class="quote-card">
        <div class="quote-text">"<?php echo htmlspecialchars($row['quote_text']); ?>"</div>
        <div class="quote-author">- <?php echo htmlspecialchars($row['author']); ?></div>
        <div class="quote-date"><?php echo date('d M Y H:i', strtotime($row['created_at'])); ?></div>
    </div>
</a> 