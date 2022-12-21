CREATE DATABASE teste;

USE teste;

CREATE TABLE usuarios(
    id INT auto_increment primary key,
    nome varchar(100) not null,
    email varchar(100) unique not null
);

INSERT INTO usuarios (nome, email) values('Hugo', 'h@email.com'),('Sara', 's@email.com');