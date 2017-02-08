# Comercio-Eletronico-PHP-AJAX

Projeto simples de comércio eletrônico desenvolvido em PHP utilizando AJAX

Banco de dados em MySql

SCRIPT DO BANCO

create database projeto;
use projeto;

CREATE TABLE cliente (

  idCliente int(11) NOT NULL PRIMARY KEY auto_increment,

  usuario varchar(45) NOT NULL,

  email varchar(45) DEFAULT NULL,

  senha varchar(8) not null
);




CREATE TABLE categoria (

  idCategoria int PRIMARY KEY auto_increment,

  descricao varchar(500) DEFAULT NULL  

);




CREATE TABLE produto (

  idProduto int PRIMARY KEY auto_increment,

  nome varchar(500) DEFAULT NULL,

  descricao varchar(500) DEFAULT NULL,

  preco double DEFAULT NULL,

  quantidade int,

  idCategoria int,

  imgUrl varchar(50) DEFAULT NULL,

  foreign key(idCategoria) references categoria(idCategoria)
 
 );
  
insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("curso de c#", "Um bom curso de C#", 25, 2, 1, "img/ccharp.jpg")

CREATE TABLE pedido (

  idPedido int(11) PRIMARY KEY auto_increment,

  dataPedido date DEFAULT NULL,  

  idCliente int(11) DEFAULT NULL,

  FOREIGN KEY (idCliente) REFERENCES cliente(idCliente) ON DELETE CASCADE ON UPDATE CASCADE
 
);

CREATE TABLE itempedido (

  idItemPedido int(11) NOT NULL PRIMARY KEY auto_increment,

  preco double NOT NULL,

  quantidade int(11) NOT NULL,

  idProduto int(11) NOT NULL,

  idPedido int(11) NOT NULL,

  FOREIGN KEY (idProduto) REFERENCES produto(idProduto) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (idPedido) REFERENCES pedido(idPedido) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE carrinho (
  idCarrinho int(11) NOT NULL auto_increment,
  codProduto int(11) NOT NULL,
  nome varchar(150) collate latin1_general_ci NOT NULL,
  preco double(10,2) NOT NULL,
  qtd int(11) NOT NULL,
  sessao text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (idCarrinho)
);

insert into categoria (descricao) value ('Cursos');
insert into categoria (descricao) value ('Eletrônicos');
insert into categoria (descricao) value ('Perfumes');
insert into categoria (descricao) value ('Informática');
insert into categoria (descricao) value ('Acessórios Femininos');
insert into categoria (descricao) value ('Eróticos');

insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("curso de c#", "Um bom curso de C#", 25, 2, 1, "img/ccharp.jpg");

insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("Adaptador wi-fi com antena", "Tenha um excelente sinal de alta qualidade", 25.00, 9, 2, "img/antena.jpg");

insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("MP5 game 4gb", "Relembre sua infancia jogando NES - Saída para TV", 80.00, 2, 5, "img/mp5.jpg");

insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("Pen Drive personalizado Heineken", "Pra você que ama a cerveja verde!", 45.00, 2, 4, "img/heineken.jpg");

insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("Pen Drive granada 8gb", "Pra você que gosta de coisas mais sinistras", 45.00, 2, 4, "img/pendrive_granada.jpg");

insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("Pen Drive arma 8gb", "Pra você que é policial ou tem vontade de matar seus colegas de sala", 45.00, 2, 4, "img/pendrive_granada.jpg");

insert into produto (nome, descricao, preco, quantidade, idCategoria, imgUrl) values 
("Pen Drive scan disk 8gb", "Ultra Mini Pendrive", 30.00, 2, 4, "img/scan disk.jpg");



select * from categoria;

select * from produto;

