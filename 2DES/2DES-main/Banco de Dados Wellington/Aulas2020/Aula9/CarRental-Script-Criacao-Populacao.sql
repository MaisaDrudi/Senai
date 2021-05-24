-- Sctript SQL de Criação (DDL) e população (DML) do Banco de dados
drop database if exists carRental;
create database carRental;
use carRental;
-- Criação das tabelas
create table prices(
    kind varchar(14) not null,
    daily decimal(6,2) not null 
);

create table cars(
    plate varchar(7) primary key not null,
    model varchar(30) not null,
    brand varchar(30) not null,
    color varchar(15) not null,
    picture mediumblob,
    year integer(4) not null,
    kind varchar(14) not null
);

create table customers(
    cpf varchar(11) primary key not null,
    name varchar(60) not null,
    picture mediumblob,
    email varchar(90) not null
);

-- Esta tabela foi criada para que o cliente possa cadastrar mais de 1 telefone (Atributo Multivalorado)
create table phones(
    cpf varchar(11) not null,
    phone varchar(11) not null
);

create table rentals(
    id integer not null primary key auto_increment,
    cpf varchar(11) not null,
    plate varchar(7) not null,
    rental_date date not null,
    return_date date,
    obs varchar(256),
    final_value decimal(7,2)
);

--Relacionamentos
-- Configura o kind (tipo) como chave primária na tabela prices e relaciona com a tabela cars
alter table prices modify column kind varchar(14) not null primary key;
alter table cars add constraint fk_cars_prices foreign key (kind) references prices(kind) on update cascade;
alter table phones add constraint fk_customer_phones foreign key (cpf) references customers(cpf) on delete cascade on update cascade;
alter table rentals add constraint fk_customer_rentals foreign key (cpf) references customers(cpf) on update cascade;
alter table rentals add constraint fk_cars_rentals foreign key (plate) references cars(plate) on update cascade;

-- Criando as visões
create view vw_renteds as
select plate, "Alugado" as status from rentals where return_date is null;

create view vw_cars as
select c.plate, c.model, c.brand, c.color, c.picture, c.year, c.kind, p.daily, 
case when r.status is null then "Disponível" else r.status end as status
from cars c inner join prices p
on c.kind like p.kind
left join vw_renteds r
on c.plate = r.plate;

create view vw_customers as
select c.cpf, c.name, c.picture, c.email, f.phone 
from customers c inner join phones f
on c.cpf like f.cpf;

create view vw_rentals as
select *,
CASE WHEN return_date is null THEN curdate() - rental_date ELSE return_date - rental_date END
as n_daily from rentals;

-- (DML) População do banco de dados com DADOS
insert into prices values
("popular",44.9),
("standard",49.9),
("suv",99.9),
("utilitario",89.9),
("esportivo",129.9),
("luxo",250);

insert into cars values
("AAA1A11","GOL","VW","Prata",null,2020,"popular"),
("BBB1A11","RANGE ROVER","LAND ROVER","Branca",null,2020,"suv"),
("CCC1A11","DOBLO","FIAT","Preta",null,2020,"utilitario"),
("DDD1A11","Cybertruck","TESLA","Prata",null,2020,"luxo");

insert into customers values
("11111111111","João da Silva",null,"joao@silva.com"),
("22222222222","Marta da Silva",null,"marta@silva.com"),
("33333333333","Juliana da Silva",null,"juliana@silva.com"),
("44444444444","Roberto da Silva",null,"roberto@silva.com"),
("55555555555","Dagoberto da Silva",null,"dagoberto@silva.com");

insert into phones values
("22222222222","19983458372"),
("22222222222","19983453245"),
("33333333333","19983323444"),
("44444444444","11982353245"),
("55555555555","19983783245"),
("55555555555","19983783455");

insert into rentals values
(default,"11111111111","AAA1A11","2020-08-01","2020-08-03","Normal",null),
(default,"44444444444","DDD1A11","2020-08-10","2020-08-13","Risco na porta dianteira esquerda",null),
(default,"11111111111","BBB1A11","2020-09-01","2020-09-03","Normal",null),
(default,"55555555555","AAA1A11","2020-09-01","2020-09-03","Sem Step",null),
(default,"22222222222","DDD1A11","2020-09-02","2020-09-08","Normal",null),
(default,"33333333333","AAA1A11","2020-09-14",null,"Normal",null),
(default,"11111111111","CCC1A11","2020-09-14",null,"Normal",null),
(default,"55555555555","BBB1A11",curdate(),null,"Normal",null);

-- Queries
select * from cars; -- Todos os carros
select * from prices; -- Todos os preços
select * from cars,prices; -- Todos os carros e preços combinados
select * from cars join prices; -- Todos os carros e preços combinados
select * from cars inner join prices; -- Todos os carros e preços combinados
select * from prices where daily > 100; -- Somente os preços acima de 100 reais
select * from cars where plate like "AAA%"; -- Filtra somente os carros com placa iniciada com AAA
select * from cars inner join prices on cars.kind like prices.kind; -- Junta as duas tabelas e filtra pelo tipo (kind)
select *, return_date - rental_date as n_daily from rentals; -- Mostra os alugéns e calcula o  número de diárias;
select * from vw_cars;
select * from vw_customers;
select * from rentals;
select * from vw_rentals;
show tables;


-- Desafio, tente criar uma Query e depois uma VIEW que calcule o valor final (finale_value).




