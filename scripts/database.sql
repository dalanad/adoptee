
DROP DATABASE IF EXISTS adoptee;

CREATE DATABASE adoptee;

use adoptee;

create table user( 
    email varchar(20) primary key ,
    name varchar(50) not null ,
    password varchar(50) not null ,
    telephone char(10) not null
);

insert into user values ('dalana@test','dalana','123','102345667');

create table organization ( 
    org_id  int(10) AUTO_INCREMENT primary key ,
    name varchar(50) not null ,
    telephone char(10) not null,
    address_line_1 varchar(20)   ,
    address_line_2 varchar(20)  ,
    city varchar(20) 
);

