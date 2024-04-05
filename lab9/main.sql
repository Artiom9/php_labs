-- Создание базы данных blog (если она не существует)
CREATE DATABASE blog;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    surname VARCHAR(50),
    email VARCHAR(100) UNIQUE
);

-- Создание таблицы comments
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    comment TEXT,
    FOREIGN KEY(user_id) REFERENCES users(id)
);
