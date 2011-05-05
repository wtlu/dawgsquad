CREATE DATABASE dawgsquad;

USE dawgsquad;

CREATE TABLE libraries(
	lib_id int
);

CREATE USER 'dawgsquad'@'localhost' IDENTIFIED BY 'QWjZcECPAyfQfYcQ';
GRANT ALL PRIVILEGES ON *.* TO 'dawgsquad'@'localhost' WITH GRANT OPTION; 
CREATE USER 'dawgsquad'@'%' IDENTIFIED BY 'QWjZcECPAyfQfYcQ';
GRANT ALL PRIVILEGES ON *.* TO 'dawgsquad'@'%' WITH GRANT OPTION; 
