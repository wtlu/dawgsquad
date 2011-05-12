create database media_db;

use media_db;

CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	password VARCHAR(50),
	facebook_id INT(11),
	created DATETIME DEFAULT NULL,
 	modified DATETIME DEFAULT NULL 
);

CREATE TABLE books(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(45),
	author VARCHAR(45),
	ISBN VARCHAR(15),
	image VARCHAR(150),
	summary TEXT(300),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL	
);

CREATE TABLE loans(
	owner_id INT,
	client_id INT,
	book_id INT,
	due_date DATETIME,
	FOREIGN KEY(owner_id) REFERENCES users(id),
	FOREIGN KEY(client_id) REFERENCES users(id),
	FOREIGN KEY(book_id) REFERENCES books(id),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

CREATE TABLE book_initial_offers(
	user_id INT,
	book_id INT,
	trade_id INT,
	duration INT,
	price DOUBLE,
	PRIMARY KEY(user_id, book_id),
	FOREIGN KEY(user_id) REFERENCES users(id),
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
	owner_id INT,
	client_id INT,
	book_id INT,
	current_id INT,
	trade_id INT,
	duration INT,
	price DOUBLE,
	status INT,
	FOREIGN KEY(owner_id) REFERENCES users(id),
	FOREIGN KEY(client_id) REFERENCES users(id),
	FOREIGN KEY(book_id) REFERENCES books(id),
	FOREIGN KEY(current_id) REFERENCES users(id),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);