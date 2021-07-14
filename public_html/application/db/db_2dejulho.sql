/**
 * Author:  neto
 * Created: 27/09/2017
 */

create table usuario(
    id serial unique not null primary key,
    nome varchar(255), /*nome completo*/
    apelido varchar(60), /*nome de tratamento ou nome de guerra*/
    email varchar(255) not null unique, /*Login / E-mail para contato*/
    senha varchar(255) not null, /*senha*/
    matricula integer, /*se houver (militar/servidor do estado...)*/
    dn date, /*data de nascimento*/
    tel varchar(60), /*número de telefone*/
    cel varchar(60), /*número de celular*/
    sexo integer default 1, /*sexo: 1-masc 2-fem*/
    status integer not null default 2 /*1 = pendente / 2=ativo*/
);






/*Configurações iniciais*/
insert into usuario (nome, apelido, email, senha, matricula, dn) values ('Claudio Neto', 'Neto', 'claudiorcneto@yahoo.com.br', md5('0000'), 9272038, '1981-03-10');
