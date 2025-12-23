

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 email VARCHAR(100) UNIQUE,
 password VARCHAR(255)
);

CREATE TABLE records (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 count_value VARCHAR(10),
 record_date DATE,
 FOREIGN KEY (user_id) REFERENCES users(id)
);
