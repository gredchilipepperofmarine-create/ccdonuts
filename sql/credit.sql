-- 1. クレジットカード情報テーブル
CREATE TABLE IF NOT EXISTS cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    card_name VARCHAR(100) NOT NULL,
    card_number VARCHAR(20) NOT NULL,
    card_month VARCHAR(2) NOT NULL,
    card_year VARCHAR(2) NOT NULL,
    security_code VARCHAR(4) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 2. 注文ヘッダーテーブル
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    total_price INT NOT NULL,
    card_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 3. 注文明細テーブル
CREATE TABLE IF NOT EXISTS order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    count INT NOT NULL,
    price INT NOT NULL
);