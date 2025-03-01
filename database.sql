CREATE DATABASE IF NOT EXISTS anonymous_quotes;
USE anonymous_quotes;

CREATE TABLE IF NOT EXISTS quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_text TEXT NOT NULL,
    author VARCHAR(100) DEFAULT 'Anonymous',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 