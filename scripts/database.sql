
DROP DATABASE IF EXISTS adoptee;

CREATE DATABASE adoptee;

use adoptee;

create table user( 
    user_id int(10) AUTO_INCREMENT primary key,
    name varchar(50) not null ,
    email varchar(20) ,
    password varchar(50) not null ,
    telephone char(10) not null,
    address varchar(150)
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

create table adoption_request (
    org_id int(10)  ,
    animal_id varchar(10)  ,
    user_id varchar(5) ,
    has_pets boolean,
    petsafety varchar(100) ,
    children boolean,
    childsafety varchar(100) ,
    primary key(org_id, animal_id, user_id)
    foreign key(org_id) references organization(org_id),
    -- foreign key(animal_id) references animal(animal_id),
    foreign key(user_id) references user(user_id)

);