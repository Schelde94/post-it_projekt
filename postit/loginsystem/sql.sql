
DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(40) UNIQUE,
    pwhash VARCHAR(255)
);

INSERT INTO users (username, pwhash) VALUES ("niels", "asdfasdfasdfasdfasdfasdfsd");

SELECT * FROM users;
SELECT id, pwhash FROM users WHERE username="niels";