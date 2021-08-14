
DROP DATABASE IF EXISTS adoptee;

CREATE DATABASE adoptee;

use adoptee;

create table user( 
    email varchar(50) primary key ,
    name varchar(50) not null ,
    password varchar(50) not null ,
    telephone char(10) not null
);

insert into user values ('dalana@test','dalana','123','102345667');

create table doctor (
    reg_no varchar(50) primary key,
    address varchar(50),
    email varchar(50),
    credentials varchar(50)
);

create table organization ( 
    org_id  int(10) AUTO_INCREMENT primary key ,
    name varchar(50) not null ,
    telephone char(10) not null,
    address_line_1 varchar(20)   ,
    address_line_2 varchar(20)  ,
    city varchar(20) 
);

create table consultation (
    consultation_id int(10) auto_increment primary key -- should we add a primary key ?
    consultation_date date not null,
    consultation_time time not null,
    animal_id int(10) not null,
    doctor_email varchar(50) not null,
    status enum('CANCELLED','PENDING','ACCEPTED','COMPLETED') not null default 'PENDING', 
    type enum('LIVE','ADVISE') not null default 'ADVISE',
    payment_txn_id varchar(50) 
)

alter table consultation   
  add primary key (`consultation_id`),
  add unique key `consultation_doctor_availability` (doctor_email, type, consultation_date, consultation_time); 
-- cancelled sessions on same time ?

create table consulataton_message(
     consultation_id int(10),
     created_at timestamp,
     medical_record_id int(10)
     message varchar(128)
)

create table medical_record (
    animal_id int(10) not null,
    created_at timestamp,
    content varchar(128) not null
)

create table medical_record_attachment(
    animal_id int(10) not null,
    created_at timestamp,
    file_path varchar(20)
)


