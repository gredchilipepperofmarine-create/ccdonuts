-- favoritesテーブルを作成
CREATE TABLE favorites (
  -- idは自動で増える(autoincrement)かつ絶対にかぶらない(primarykey)
  id INT AUTO_INCREMENT PRIMARY KEY,
  -- 空は禁止(notNull)
  customer_id INT NOT NULL,
  product_id INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP, 

  -- customer_idはcustomers(id)からのみ持ってこれる、それが削除されたら削除する(delete cascade)
  FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,

  UNIQUE (customer_id, product_id)
);