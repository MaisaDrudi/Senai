drop database if exists compras; --Remove se ele existe
--Criação de um Banco de dados
create database compras;
use compras;
create table produtos(
    codProd integer not null auto_increment,
    nome varchar(50) not null,
    descricao varchar(256),
    preco decimal(6,2) not null,
    quantidade integer not null,
    primary key(codProd)
);

create table marcas(
    codProd integer not null,
    marca varchar(40) not null,
    constraint fk_marca_produto foreign key (codProd) references produtos(codProd) on update cascade on delete cascade
);

create table compras(
    numero integer not null auto_increment,
    data date not null,
    hora time not null,
    quantidade integer not null,
    codProd integer not null,
    primary key(numero),
    constraint fk_compras_produtos foreign key(codProd) references produtos(codProd) on delete cascade
);

--Popula o banco de dados com registros de TESTE
insert into produtos (nome,descricao,preco,quantidade) values ("Martelo","Martelo comum",19.90,10);
insert into produtos values
(default,"Alicate","Alicate universal",19.90,10),
(default,"Trena",null,9.90,10),
(default,"Colher de Pedreiro","Pequena",7.90,10),
(default,"Prumo","Básico",8.95,10),
(default,"Nível","De Alumíneo",12.90,10);

insert into marcas (marca, codProd)
values
("Bosh",1),
("Bosh",2),
("Bosh",3),
("Bosh",5),
("Acme",1),
("Acme",2),
("Acme",3),
("Acme",5),
("Acme",4),
("Acme",6);

insert into compras values
(default,"2020-08-01","10:30",3,1),
(default,"2020-08-01","11:30",1,2),
(default,"2020-08-02","10:45",2,1),
(default,"2020-08-02","14:30",4,6),
(default,"2020-08-03","15:35",1,5);

select * from produtos;
select * from marcas;
select * from compras;

