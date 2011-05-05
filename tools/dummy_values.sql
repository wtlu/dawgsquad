use media_db;

INSERT INTO users(fname, lname, created)
	VALUES("Wei-Ting", "Lu", NOW());
	
INSERT INTO users(fname, lname, created)
	VALUES("Troy", "Martin", NOW());
	
INSERT INTO book_initial_offers(user_id, book_id, trade_id, duration, price, created)
	VALUES(2, 1, 1, 5, 50, NOW());
	
INSERT INTO book_initial_offers(user_id, book_id, trade_id, duration, price, created)
	VALUES(1, 2, 2, 10, 100, NOW());
	
INSERT INTO book_initial_offers(user_id, book_id, trade_id, duration, price, created)
	VALUES(2, 3, 3, 10, 100, NOW());
	
INSERT INTO books(title, author, ISBN, image, summary, created)
	VALUES("Operating System Concepts", "Abraham Silberschatz", 0470128720, "http://books.google.com/books?id=g710PwAACAAJ&printsec=frontcover&img=1&zoom=1&l=220", "Operating System Concepts, Eighth Edition remains as current and relevant as ever, helping you master the fundamental concepts of operating systems while preparing yourself for today’s emerging developments.", NOW());
	
INSERT INTO books(title, author, ISBN, image, summary, created)
	VALUES("Web Programming", "Marty Stepp", 0578012391, "http://ecx.images-amazon.com/images/I/51eeDpZ1VQL._SL500_AA300_.jpg", "Web programming stuff.", NOW());
	
INSERT INTO books(title, author, ISBN, image, summary, created)
	VALUES("Building Java Programs", "Stuart Reges", 0136091813, "http://ecx.images-amazon.com/images/I/51EEKpJ3DwL._SL500_AA300_.jpg", "Java programming stuff", NOW());
	
INSERT INTO loans(owner_id, client_id, book_id, due_date, created)
	VALUES(2, 1, 1, '2011-06-10', NOW());
	
INSERT INTO transactions(owner_id, client_id, book_id, current_id, trade_id, duration, price, status, created)
	VALUES(2, 1, 1, 1, NULL, 5, NULL, 0, NOW());
	
INSERT INTO trades(id, book_id, created)
	VALUES(1, 2, NOW());
	
INSERT INTO trades(id, book_id, created)
	VALUES(2, 1, NOW());
	
INSERT INTO trades(id, book_id, created)
	VALUES(2, 3, NOW());
	
INSERT INTO trades(id, book_id, created)
	VALUES(3, 2, NOW());	