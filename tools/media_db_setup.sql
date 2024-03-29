create database media_db_test;

create database media_db;

use media_db;

CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	password VARCHAR(50),
	facebook_id BIGINT(20),
	created DATETIME DEFAULT NULL,
 	modified DATETIME DEFAULT NULL 
);

CREATE TABLE books(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(200),
	author VARCHAR(200),
	ISBN VARCHAR(50),
	image VARCHAR(150),
	summary TEXT(300),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL	
);

CREATE TABLE loans(
	owner_id BIGINT,
	client_id BIGINT,
	book_id INT,
	due_date DATE,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

CREATE TABLE book_initial_offers(
	user_id BIGINT,
	book_id INT,
	trade_id INT,
	duration INT,
	price DOUBLE,
	PRIMARY KEY(user_id, book_id),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

CREATE TABLE trades(
	id INT,
	book_id INT,
	PRIMARY KEY(id, book_id),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

CREATE TABLE transactions(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	owner_id BIGINT,
	client_id BIGINT,
	book_id INT,
	current_id INT,
	trade_id INT,
	duration INT,
	price DOUBLE,
	status INT,
	FOREIGN KEY(book_id) REFERENCES books(id),
	deleted INT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);