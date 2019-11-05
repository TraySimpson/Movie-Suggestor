Tray Simpson

//For user table
CREATE TABLE user (email varchar(256) NOT NULL PRIMARY KEY, 
password varchar(64) NOT NULL, name varchar (64));

//Movies table, filled/created by IMDB database
CREATE TABLE movies (id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
title varchar(256), rating float);

//Table that links user to saved movies
CREATE TABLE mymovies (id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
user varchar(256) NOT NULL, movie integer NOT NULL);