-- DAYDREAM Café database. Import in phpMyAdmin (http://localhost/phpmyadmin > Import)
CREATE DATABASE IF NOT EXISTS daydream CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE daydream;

DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS gallery;
DROP TABLE IF EXISTS messages;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category ENUM('Coffee','Matcha','Tea','Cold Drinks','Desserts') NOT NULL,
  description VARCHAR(255) NOT NULL,
  price DECIMAL(6,2) NOT NULL,
  emoji VARCHAR(10) NOT NULL DEFAULT '☕',
  is_featured TINYINT(1) NOT NULL DEFAULT 0,
  is_bestseller TINYINT(1) NOT NULL DEFAULT 0,
  is_seasonal TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE gallery (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  caption VARCHAR(255) NOT NULL,
  emoji VARCHAR(10) NOT NULL DEFAULT '✨',
  image_file VARCHAR(150) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  subject VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  status ENUM('new','replied') NOT NULL DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, category, description, price, emoji, is_featured, is_bestseller, is_seasonal) VALUES
('Cloud Latte','Coffee','Double espresso, steamed milk and a pillow of vanilla foam.',18.00,'☕',1,1,0),
('Caramel Daydream','Coffee','Espresso, silky caramel and milk, topped with sea salt.',20.00,'🍮',1,1,0),
('Flat White','Coffee','Two shots of espresso with velvety micro-foam.',16.00,'☕',0,0,0),
('Pink Matcha Latte','Matcha','Ceremonial matcha, strawberry milk and a rose finish.',22.00,'🍵',1,1,0),
('Classic Matcha','Matcha','Stone-ground matcha whisked with your choice of milk.',19.00,'🍵',0,0,0),
('Jasmine Pearl Tea','Tea','Hand-rolled jasmine pearls, brewed fresh to order.',14.00,'🫖',0,0,0),
('Rose Earl Grey','Tea','Earl Grey with dried rose petals and a touch of honey.',15.00,'🌹',1,0,0),
('Iced Peach Oolong','Cold Drinks','Cold-brewed oolong with ripe peach and mint.',17.00,'🍑',0,0,0),
('Berry Cloud Cold Brew','Cold Drinks','Cold brew, mixed berries and sweet cream foam.',21.00,'🫐',1,1,0),
('Strawberry Cheesecake Slice','Desserts','Baked cheesecake, strawberry compote, biscuit crumb base.',24.00,'🍰',1,1,0),
('Pistachio Croissant','Desserts','Buttery croissant filled with pistachio cream.',16.00,'🥐',0,1,0),
('Tiramisu Cup','Desserts','Espresso-soaked sponge, mascarpone and cocoa.',19.00,'🍨',0,0,0),
('Pumpkin Spice Latte','Coffee','Espresso, pumpkin purée, cinnamon and nutmeg. Fall only.',22.00,'🎃',0,0,1),
('Maple Pecan Cold Brew','Cold Drinks','Cold brew with maple syrup and toasted pecan cream.',23.00,'🍂',0,0,1),
('Cinnamon Apple Chai','Tea','Spiced chai, warm apple and a cinnamon stick.',20.00,'🍎',0,0,1),
('Salted Caramel Apple Tart','Desserts','Warm apple tart with salted caramel drizzle.',25.00,'🥧',0,0,1);

INSERT INTO products (name, category, description, price, emoji, is_featured, is_bestseller, is_seasonal) VALUES
('Signature Chocolate Fudge Cake','Desserts','Rich, triple-layered chocolate cake with ganache.',25.00,'🍫',0,0,0),
('Classic New York Cheesecake','Desserts','Creamy cheesecake with a graham cracker crust and strawberry glaze.',30.00,'🍰',0,0,0),
('Warm Apple Galette','Desserts','Flaky pastry filled with spiced apples, served with vanilla bean ice cream.',20.00,'🥧',0,0,0),
('Artest Latté','Coffee','Espresso with steamed milk and a delicate layer of foam.',18.00,'☕',0,0,0),
('Matcha Latte','Matcha','Premium Japanese matcha whisked with steamed oat milk.',25.00,'🍵',0,0,0),
('Iced Hibiscus Berry Infusion','Cold Drinks','Refreshing, tart, and naturally sweet herbal iced tea.',22.00,'🌺',0,0,0);

INSERT INTO gallery (title, caption, emoji) VALUES
('Morning Pour','The first cup of the day, poured slow.','☕'),
('Pink Matcha Hour','Our most photographed drink.','🍵'),
('Window Seat','Sunlight, a book and nowhere to be.','🪟'),
('Dessert Counter','Baked fresh every morning.','🍰'),
('Latte Art','Every cup gets a little signature.','🤍'),
('Evening Glow','Open until 11 pm, Sunday to Thursday.','🌙');

INSERT INTO messages (name, email, subject, message, status) VALUES
('Lina Alharbi','lina@example.com','Birthday booking','Can I reserve a table for 8 people on Thursday evening?','new'),
('Omar Saleh','omar@example.com','Oat milk','Do you offer oat or almond milk for all drinks?','replied'),
('Sara Khan','sara@example.com','Compliment','The pink matcha latte made my week. Thank you!','replied'),
('Nora Ahmed','nora@example.com','Catering','Do you do catering for small office events?','new'),
('Yousef Ali','yousef@example.com','Opening hours','Are you open on Fridays?','new');

