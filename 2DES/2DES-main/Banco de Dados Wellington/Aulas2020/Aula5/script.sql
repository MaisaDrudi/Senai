--Como estamos em desenvolvimento DDL configuramos o script para remover o banco aterior e criar um novo
drop database if exists hortelinoCompras;
create database hortelinoCompras;
use hortelinoCompras;

--Criamos as tabelas iniciando pelas tabelas FORTES
create table Produtos(
    codigo integer primary key auto_increment not null,
    nome varchar(40) not null,
    descricao varchar(200) not null,
    preco decimal(6,2) not null,
    quantidade integer not null
);

--Em seguida a tabela FRACA e o RELACIONAMENTO
create table Compras(
    num integer primary key auto_increment not null,
    data Date not null,
    hora Time not null,
    codProduto integer not null,
    quantidade integer not null,
    preco decimal(6,2) not null,
    constraint fkProdutosCompras 
    foreign key (codProduto)
    references Produtos(codigo)
    on delete cascade
    on update cascade
);

--Para popular (Preencer o Banco de dados com Registros) e testar o Banco de dados DML
insert into Produtos values
(default,"Porca","Porca",0.99,887),
(default,"Parafuso","Parafuso",2.9,690),
(default,"Prego","Prego",1.99,1000),
(default,"Prego","Prego Grande",0.1,780),
(default,"Luva pequena","Luva PVC",2.99,1000),
(default,"Lâmpada Florecente","Lâmpada Florecente",6.45,98),
(default,"Lâmpada Led","Lâmpadas de LED",18.3,300),
(default,"Chave de Fenda","Chave de Fenda Grande",13.45,98),
(default,"Parafuzo","Parafuzo Sextavado",10.0,100);

insert into Compras values (default,"	2020-06-28	","	06:20	",	2	,	100	,	2.99	);
insert into Compras values (default,"	2020-06-28	","	06:22	",	2	,	10	,	2.99	);
insert into Compras values (default,"	2020-06-29	","	06:23	",	4	,	20	,	0.1	);
insert into Compras values (default,"	2020-06-29	","	06:20	",	2	,	100	,	2.99	);
insert into Compras values (default,"	2020-06-29	","	06:22	",	2	,	10	,	2.99	);
insert into Compras values (default,"	2020-06-29	","	06:23	",	4	,	20	,	0.1	);
insert into Compras values (default,"	2020-06-30	","	06:20	",	2	,	100	,	2.99	);
insert into Compras values (default,"	2020-06-30	","	06:22	",	2	,	10	,	2.99	);
insert into Compras values (default,"	2020-06-30	","	06:23	",	4	,	20	,	0.1	);
insert into Compras values (default,"	2020-07-01	","	09:39	",	8	,	2	,	13.45	);
insert into Compras values (default,"	2020-07-20	","	10:46	",	4	,	100	,	0.1	);
insert into Compras values (default,"	2020-08-03	","	08:38	",	1	,	12	,	0.99	);

describe Produtos;
describe Compras;

Select * from Produtos;
Select * , preco * quantidade as subtotal from Produtos;

Select * from Compras;
Select * , preco * quantidade as subtotal from Compras;

