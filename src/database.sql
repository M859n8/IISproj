CREATE DATABASE green_market;
-- CREATE DATABASE IF NOT EXISTS green_market DEFAULT CHARACTER SET utf8 ; -- from github
USE green_market;
------DROP ALL TABLE-----

-------------------------

-----CREATE TABLE--------

-------------------------------------SECOND VARIANT
-- CREATE TABLE IF NOT EXISTS users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(20) NOT NULL, -- in github everywhere simple NULL -- why?
--     second_name VARCHAR(20) NOT NULL, 
--     username VARCHAR(255) UNIQUE NOT NULL, 
--     password VARCHAR(255) NOT NULL,
--     email VARCHAR(255) UNIQUE NOT NULL,          
--     phone VARCHAR(15) NOT NULL, 
--     role ENUM('admin', 'moderator', 'farmer', 'customer','not_reg') NOT NULL  
-- );

CREATE TABLE IF NOT EXISTS not_reg_user (
    id_user INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS moderator (
    id_moderator INT PRIMARY KEY REFERENCES not_reg_user(id_user),
    username VARCHAR(255) UNIQUE NOT NULL, 
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS admin (
    id_admin INT PRIMARY KEY REFERENCES moderator(id_moderator)
);

CREATE TABLE IF NOT EXISTS user (
    id_reg_user INT PRIMARY KEY REFERENCES not_reg_user(id_user),
    name VARCHAR(20) NOT NULL, -- in github everywhere simple NULL -- why?
    second_name VARCHAR(20) NOT NULL, 
    username VARCHAR(255) UNIQUE NOT NULL, 
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,          
    phone VARCHAR(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS farmer (
    id_farmer INT PRIMARY KEY REFERENCES user(id_reg_user)
);

CREATE TABLE IF NOT EXISTS customer (
    id_customer INT PRIMARY KEY REFERENCES user(id_reg_user)
);

CREATE TABLE IF NOT EXISTS category (
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent_id INT,
    moderator_id INT,
    FOREIGN KEY (parent_id) REFERENCES category(id_category),
    FOREIGN KEY (moderator_id) REFERENCES moderator(id_moderator)
);

CREATE TABLE IF NOT EXISTS product (
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    price_type ENUM('per_kg', 'per_unit') NOT NULL, -- Тип ціни (за кіло або за штуку) треба допрацювати
    amount VARCHAR(255) NOT NULL,
    evaluation DECIMAL(2, 1) CHECK (evaluation BETWEEN 1.0 AND 5.0) NOT NULL,
    place TEXT,
    category_id INT,
    farmer_id INT,
    FOREIGN KEY (category_id) REFERENCES category(id_category),
    FOREIGN KEY (farmer_id) REFERENCES farmer(id_farmer)
);