
CREATE DATABASE main_db;
USE main_db;

CREATE USER 'cake'@'localhost' IDENTIFIED BY 'the cake is a lie';
GRANT ALL PRIVILEGES ON main_db.* TO 'cake'@'localhost';

CREATE TABLE challenge (
    id int NOT NULL AUTO_INCREMENT,
    string_id varchar(32) UNIQUE,
    player1 varchar(128) NOT NULL,
    player2 varchar(128) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE game (
    challenge_id int,
    board_state varchar(9) NOT NULL,
    timestamp timestamp NOT NULL,
    FOREIGN KEY(challenge_id)
        REFERENCES challenge(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

