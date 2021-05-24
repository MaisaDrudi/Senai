drop database if exists arnaldo;
create database arnaldo;
use arnaldo;

create table Mercadorias(
	cod integer auto_increment not null, 
	nome varchar(40) not null,
    valor decimal(6,2) not null,
    quantidade integer not null,
    primary key (cod)
);

create table Compras(
	cod integer auto_increment not null, 
    cod_merc integer not null,
    data timestamp not null,
    custo decimal(6,2) not null,
    quantidade integer not null,
	primary key (cod),
    constraint fk_cod_merc foreign key (cod_merc)
	references Mercadorias(cod)
);

create table Vendas(
	cod integer auto_increment not null,
    cod_merc integer not null,
	quantidade integer not null,
    preco decimal(6,2) not null,
	primary key (cod),
    constraint fk_cod_vendas 
    foreign key (cod_merc)
    references Mercadorias(cod)    
);

-- Estes gatilhos e inserts seguem a seguinte regra
-- O valor é 25% menor que o preço
-- O preço é 200% maior que o custo

-- Este gatilho atualiza a quantidade de mercadorias quando ela é comprada
create trigger tr_mercadoria_comprada after insert on Compras
for each row
update Mercadorias set quantidade = quantidade + new.quantidade where cod = new.cod_merc;

-- Este gatilho atualiza a quantidade de mercadorias quando ela é vendida e também atualiza do valor para 25% menos que o preço
create trigger tr_mercadoria_vendida after insert on Vendas
for each row
update Mercadorias set
quantidade = quantidade - new.quantidade,
valor = new.preco - new.preco * 0.25
 where cod = new.cod_merc;

describe Compras;
describe Mercadorias;
describe Vendas;
show tables;


insert into Mercadorias(nome, valor, quantidade) values
("Caixa Para Doces",4.30,520),
("Caixa Para Doces Grande",3.20,520),
("Cartaz Decorativo Natal",17.99,210),
("Faixa Decorativa",14.9,78),
("Palitos Decorativos Biscoito",5.68,100),
("Palitos Decorativos Duende",5.68,100),
("Palitos Decorativos Pinguim",5.68,100),
("Pacote Balões Festivos",22.30,54),
("Kit Natalino",53.90,40);

select * from Mercadorias;

insert into Compras(cod_merc, data, custo, quantidade) values (1, NOW(),	2.99 ,	100	);
insert into Compras(cod_merc, data, custo, quantidade) values (2, NOW(),	2.99 ,	10	);
insert into Compras(cod_merc, data, custo, quantidade) values (3, NOW(),	10.50 ,	20	);
insert into Compras(cod_merc, data, custo, quantidade) values (4, NOW(),	10.99 ,	100	);
insert into Compras(cod_merc, data, custo, quantidade) values (5, NOW(),	3.20 ,	10	);
insert into Compras(cod_merc, data, custo, quantidade) values (6, NOW(),	3.20,	20	);
insert into Compras(cod_merc, data, custo, quantidade) values (7, NOW(),	3.20,	100	);
insert into Compras(cod_merc, data, custo, quantidade) values (8, NOW(),	20.99,	10	);
insert into Compras(cod_merc, data, custo, quantidade) values (9, NOW(),	40.30,	20	);


select * from Compras;
-- Ao inserir a venda o preço de venda é definido como 200% sobre o custo
insert into Vendas(cod_merc, preco, quantidade) values (1,(select custo * 2 from compras where cod_merc = 1 order by custo desc limit 1),	50	);
insert into Vendas(cod_merc, preco, quantidade) values (2,(select custo * 2 from compras where cod_merc = 2 order by custo desc limit 1),	8	);
insert into Vendas(cod_merc, preco, quantidade) values (3,(select custo * 2 from compras where cod_merc = 3 order by custo desc limit 1),	15	);
insert into Vendas(cod_merc, preco, quantidade) values (4,(select custo * 2 from compras where cod_merc = 4 order by custo desc limit 1),  96	);
insert into Vendas(cod_merc, preco, quantidade) values (5,(select custo * 2 from compras where cod_merc = 5 order by custo desc limit 1),	5	);
insert into Vendas(cod_merc, preco, quantidade) values (6,(select custo * 2 from compras where cod_merc = 6 order by custo desc limit 1),	4	);
insert into Vendas(cod_merc, preco, quantidade) values (7,(select custo * 2 from compras where cod_merc = 7 order by custo desc limit 1),	69	);
insert into Vendas(cod_merc, preco, quantidade) values (8,(select custo * 2 from compras where cod_merc = 8 order by custo desc limit 1),	9	);
insert into Vendas(cod_merc, preco, quantidade) values (9,(select custo * 2 from compras where cod_merc = 9 order by custo desc limit 1),	17	);
