drop database if exists usuarios;
create database usuarios;
use usuarios;
create table pessoas(
	id_pessoa integer not null auto_increment, 
	nome varchar(40) not null,
	primary key (id_pessoa)
);
create table telefones(
	id_pessoa integer not null,
	telefone varchar(15) not null,
	constraint fk_tel_pess foreign key (id_pessoa)
	references pessoas(id_pessoa)
);
create table usuarios(
	id_pessoa integer not null,
	login varchar(12) not null,
	senha varchar(50) not null,
	constraint fk_possui foreign key (id_pessoa)
	references pessoas(id_pessoa)
);

describe pessoas;
describe telefones;
describe usuarios;
show tables;

insert into pessoas(nome) values
("Leonardo"),
("Rodolpho"),
("Jurema");
insert into pessoas(nome) values ("Marcia Souza");
insert into pessoas(nome) values ("Rodrigo vieira");
insert into pessoas values (default,"Maria Silva");

select * from pessoas;

insert into telefones(id_pessoa,telefone) values 
(1,"19 45677-7897"),
(1,"19 98787-7897");
insert into telefones values (3,"19 88888-8888");
insert into telefones values (5,"19 46546-7879");

select * from telefones;

update pessoas set nome = "Leonardo Silva"
where id_pessoa = 1;
update pessoas set nome = "Rodolpho Vieira"
where id_pessoa = 2;
update pessoas set nome = "Jurema Andrade"
where id_pessoa = 3;

-- Mostra somente as pessoas que possuem telefones
select p.id_pessoa, p.nome, t.telefone
from pessoas p inner join telefones t
on p.id_pessoa = t.id_pessoa;

-- Mostra a tabela da esquerda (pessoas) completa
create view vw_pessoas as
select p.id_pessoa, p.nome, t.telefone
from pessoas p left join telefones t
on p.id_pessoa = t.id_pessoa
order by p.id_pessoa;

select * from vw_pessoas;

insert into usuarios
(login,senha,id_pessoa)
 values
("silva.leonar",md5("Senh@123"),1),
("vieira.rodol",md5("Senh@123"),2),
("andrade.jure",md5("Senh@123"),3),
("souza.marcia",md5("Senh@123"),4),
("vieira.rodri",md5("Senh@123"),5),
("silva.maria",md5("Senh@123"),6);

select * from usuarios;
select * from usuarios where senha = md5("Senh@123");

/*
md5() Função que gera um tipo de criptografia HASH.
password() Função que gera um tipo de criptografia.
AES_ENCRYPT e AES_DECRYPT precisam de uma Chave
insert into usuarios values
(1,"silva.leonar",AES_ENCRYPT("Senh@123","123"));
select login,AES_DECRYPT(senha,"123")
from usuarios
where id_pessoa = 1;
*/


