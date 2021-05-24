-- Aula 11 - Vamos aprender sobre campos BLOB (Campos que podemos armazenar arquivos(imagens, sons, videos..))
-- Para isso criamos um banco de dados simples de pedidos onde os produtos possuem imagem (picture)
-- Para aproveitar vamos praticar inglês e os conceitos já estudados de relacionamentos.
drop database if exists orders;
create database orders;
use orders;
create table products(
    id_prod integer not null primary key auto_increment,
    name varchar(50) not null,
    quantity integer not null,
    picture mediumblob
);

create table orders(
    n_order integer not null auto_increment,
    order_date date not null,
    delivery_date date,
    primary key (n_order)
);
-- A tabela order_items foi criada por causa o relacionamento N para N
-- Ela gerencia os ítens do pedido, pois um pedido pode ter vários "N" produtos
-- Dessa forma, então, o quantidade e o valor passam da tabela de pedidos para a tabela ítens.
create table order_items(
    n_order integer not null,
    id_prod integer not null,
    quantity integer not null,
    unit_value decimal(8,2) not null,
    constraint fk_items_orders foreign key (n_order) references orders(n_order) on delete cascade,
    constraint fk_items_products foreign key (id_prod) references products(id_prod),
    primary key (n_order,id_prod) -- Chave primaria MULTIPLA
);
-- A tabela ítens serve apenas para ligar produtos a pedidos, não necessita de chave primária
-- somente das duas chaves estrangeiras que ligam as outras duas tabelas.
-- Porém para praticar e e aprender sobre chaves compostas, criamos uma chave prímária composta

-- Tamanhos dos BLOB
-- BLOB (16Bits = 16535 caracteres)
-- MEDIUMBLOB (24Bits = 16 milhões de caracteres)
-- LONGBLOB (32Bits = 4 bilhões de caracteres)

insert into products values
(default,"Grape",100,null),
(default,"Water Mellon",50,null),
(default,"Pineaple",75,null),
(default,"Banana",150,null),
(default,"Apple",200,null),
(default,"Orange",80,null),
(default,"Strawberry" ,100,null),
(default,"Bluebarry",100,null),
(default,"Jackfruit",20,null);

insert into orders values
(default,curdate()-4,curdate()-3), -- Pedido feito a 4 dias atrás e entregue a 3 dias
(default,curdate()-4,curdate()-3), -- Pedido feito a 4 dias atrás e entregue a 3 dias
(default,curdate()-3,curdate()-3), -- Pedido feito a 3 dias atrás e entregue a 3 dias
(default,curdate()-3,curdate()-3), -- Pedido feito a 3 dias atrás e entregue a 3 dias
(default,curdate(),curdate()), -- Pedido feito hoje e entregue hoje
(default,curdate(),curdate()), -- Pedido feito hoje e entregue hoje
(default,curdate(),null), -- Pedido feito hoje e não foi entregue ainda
(default,curdate(),null); -- Pedido feito hoje e não foi entregue ainda

insert into order_items values
(1,1,10,12.00),
(1,2,2,3.45),
(2,3,5,5.5),
(2,4,1,3.99),
(3,1,5,12.00),
(3,2,1,3.45),
(3,3,5,5.5),
(3,4,1,3.99),
(4,7,2,10),
(4,8,2,25.9),
(4,9,1,5),
(5,1,10,12.00),
(5,2,2,3.45),
(6,3,5,5.5),
(6,4,1,3.99),
(7,1,5,12.00),
(7,2,1,3.45),
(7,3,5,5.5),
(7,4,1,3.99),
(8,7,2,10),
(8,8,2,25.9),
(8,9,1,5);

create view vw_orders as
select
    o.n_order, o.order_date, o.delivery_date,
    i.id_prod,
    p.name,
    i.quantity, i.unit_value, i.quantity * i.unit_value as sub_total
from orders o inner join order_items i
on  o.n_order = i.n_order
inner join products p
on i.id_prod = p.id_prod;

-- Queries
select * from products;
select * from orders;
select * from order_items;
select * from vw_orders;
show tables;
select id_prod,name,quantity from products;
