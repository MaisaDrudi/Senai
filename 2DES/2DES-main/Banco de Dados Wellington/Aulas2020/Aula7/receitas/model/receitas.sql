drop database if exists receitas;
create database receitas;
use receitas;

create table receitas(
    id integer primary key auto_increment not null,
    tipo varchar(30) not null,
    nome varchar(50) not null,
    ingredientes varchar(500) not null,
    modo_de_fazer varchar(500) not null,
    foto mediumblob,
    tipo_foto varchar(4)
);
describe receitas;
select * from receitas;


