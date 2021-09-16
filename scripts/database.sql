
DROP DATABASE IF EXISTS adoptee;

CREATE DATABASE adoptee;

use adoptee;

create table user( 
    user_id int(10) AUTO_INCREMENT primary key,
    name varchar(50) not null ,
    email varchar(50) unique ,
    telephone char(10) not null,
    address varchar(150),
    password varchar(64) not null,
    email_verified boolean default 0,
    telephone_verified boolean default 0
);

create table doctor (
    user_id int(10) primary key,
    reg_no varchar(50) unique,
    telephone_fixed char(10),
    credentials varchar(50),
    proof_image varchar(50)
);

create table organization ( 
    org_id int(10) AUTO_INCREMENT primary key ,
    name varchar(50) not null ,
    telephone char(10) not null,
    address_line_1 varchar(50)   ,
    address_line_2 varchar(50)  ,
    city varchar(20) ,
    tagline varchar(50),
    logo varchar(50),
    about varchar(200),
    about_photo varchar(50)
);

create table org_user (
    user_id int(10) ,
    org_id  int(10),
    role enum('ADMIN','NORMAL') not null default 'NORMAL',
    primary key(user_id,org_id)
);

create table routine_updates (
    animal_id int(10),
    user_id int(10),
    description varchar(100) ,
    update_date date
);

create table animal (
    animal_id int(10) AUTO_INCREMENT not null,
    type varchar(10),
    other varchar(10), 
    name varchar(50),
    gender varchar(10),
    dob date,
    color varchar(50),
    primary key(animal_id)
);

create table animal_for_adoption (
    animal_id int(10) not null,
    description varchar(1000),
    date_listed date,
    status enum('LISTED','ADOPTED') not null default 'LISTED',
    date_adopted date,
    org_id int(10),
    user_id int(10),
    primary key(animal_id)
);

create table animal_for_adoption_photos(
    animal_id int(10) not null,
    photo varchar(100) not null, 
    primary key(animal_id, photo)
);

create table rescued_animal (
    animal_id int(10) primary key,
    report_id int(10),
    rescued_date date
);

create table user_pet (
    animal_id int(10) primary key,
    user_id int(10)
);

create table consultation (
    consultation_id int(10) auto_increment primary key, -- should we add a primary key ?
    consultation_date date not null,
    consultation_time time not null,
    animal_id int(10) not null,
    doctor_user_id int(10),
    user_id int(10),
    status enum('CANCELLED','PENDING','ACCEPTED','COMPLETED') not null default 'PENDING', 
    type enum('LIVE','ADVISE') not null default 'ADVISE',
    payment_txn_id varchar(50) 
);

create table consultation_schedule (
    doctor_user_id int(10),
    day_of_week int(1),
    time_slot time,
    available boolean default 0
);

alter table consultation   
  add unique key `consultation_doctor_availability` (doctor_user_id, type, consultation_date, consultation_time); 
-- cancelled sessions on same time ?

create table consultation_message (
     consultation_id int(10),
     created_at timestamp DEFAULT CURRENT_TIMESTAMP,
     medical_record_id int(10),
     sender int(10) not null,
     message varchar(128),
     primary key (consultation_id, created_at)
);

create table medical_record (
    medical_record_id int(10) auto_increment primary key,
    animal_id int(10) not null,
    created_at timestamp,
    content varchar(128) not null
);

create table medical_record_attachment(
    animal_id int(10) not null,
    created_at timestamp,
    file_path varchar(20)
);

create table prescription (
    medical_record_id int(10),
    next_visit_date date
);

create table prescription_item (
    medical_record_id int(10),
    dose int(20),
    duration varchar(20),
    direction varchar(20),
    medicine_id int (10)

);

create table medicine (
    medicine_id int (10) auto_increment primary key,
    name varchar(100)
);

create table payment (
    txn_id varchar(50) primary key,
    amount float,
    txn_date date 
);

create table donation (
    org_id int(10),
    txn_id varchar(50) primary key,
    message varchar(200),
    subscription_id int(10) 
);

create table sponsorship_tier(
  org_id int(10),
  name varchar(50),
  amount int(10) not null,
  recurring_days int(10) not null,
  description varchar(100),
  primary key(org_id,name)
);

create table sponsorship (
  subscription_id int(10) AUTO_INCREMENT primary key,
  org_id int(10),
  name varchar(50),
  user_id int(10),
  amount_at_subscription int(10) not null,
  start_date date,
  end_date date,
  status enum('ACTIVE','CANCELLED') not null default 'ACTIVE'
);

create table report_rescue(
    org_id int(10),
    report_id int(10) AUTO_INCREMENT primary key,
    type varchar(50), -- animal type
    description varchar(200),
    date_reported date default CURRENT_DATE,
    time_reported timestamp DEFAULT CURRENT_TIMESTAMP,
    contact_number int(10),
    location varchar(100) not null,
    location_coordinates varchar(100) ,
    status enum('PENDING','ACCETPED','RESCUED') not null default 'PENDING',
    org_response enum('RESCUE','ACCEPTED','RESCUED') not null default 'RESCUE',
    photo varchar(100) not null, -- JSON ?
    foreign key(org_id) references organization(org_id)
);

create table org_content (
    item_id int(10) AUTO_INCREMENT primary key,
    org_id int(10),
    created_time timestamp  DEFAULT CURRENT_TIMESTAMP,
    heading varchar(50),
    description varchar(200),
    photo varchar(200) -- JSON ?
);

create table org_feedback (
    org_id int(10),
    user_id int(10),
    created_time timestamp  DEFAULT CURRENT_TIMESTAMP,
    content varchar(200)
);

create table org_merch_item (
    org_id int(10),
    name varchar(100),
    sku varchar(50),
    price float,
    stock int(10),
    photos varchar(200), -- JSON ?,
    primary key(org_id,sku)
);

create table merch_purchase(
    order_id int(10) AUTO_INCREMENT primary key,
    user_id int(10),
    created_time timestamp  DEFAULT CURRENT_TIMESTAMP,
    status enum('CANCELLED','SHIPPED','PENDING') not null default 'PENDING',
    address_line_1 varchar(50)   ,
    address_line_2 varchar(50)  ,
    city varchar(20) ,
    payment_txn_id varchar(50)
);

create table merch_purchase_item (
    order_id int(10),
    org_id int(10),  
    sku varchar(50),
    quantity int(10),
    primary key (order_id,org_id,sku)
);

create table adoption_request (
    animal_id int(10),
    user_id int(10),
    org_id int(10),
    request_date date,
    approval_date date,
    status enum('PENDING','APPROVED','REJECTED') not null default 'PENDING',
    has_pets boolean,
    petsafety varchar(100) ,
    children boolean,
    childsafety varchar(100) ,
    primary key(animal_id, user_id)
);

alter table adoption_request
add foreign key(org_id) references organization(org_id),
add foreign key(animal_id) references animal(animal_id),
add foreign key(user_id) references user(user_id);

alter table doctor
add foreign key(user_id) references user(user_id);

alter table org_user
add foreign key(org_id) references organization(org_id),
add foreign key(user_id) references user(user_id);

alter table animal_for_adoption
add foreign key(user_id) references user(user_id);

alter table routine_updates
add foreign key(user_id) references user(user_id),
add foreign key(animal_id) references animal(animal_id);

alter table animal_for_adoption
add foreign key(org_id) references organization(org_id),
add foreign key(animal_id) references animal(animal_id);

alter table animal_for_adoption_photos
add foreign key(animal_id) references animal(animal_id);

alter table rescued_animal
add foreign key(report_id) references report_rescue(report_id),
add foreign key(animal_id) references animal(animal_id);

alter table user_pet
add foreign key(animal_id) references animal(animal_id),
add foreign key(user_id) references user(user_id);

alter table consultation
add foreign key(user_id) references user(user_id),
add foreign key(animal_id) references animal(animal_id);

alter table consultation_message
add foreign key(consultation_id) references consultation(consultation_id);

alter table medical_record
add foreign key(animal_id) references animal(animal_id);

alter table medical_record_attachment
add foreign key(animal_id) references animal(animal_id);

alter table prescription
add foreign key(medical_record_id) references medical_record(medical_record_id);

alter table prescription_item
add foreign key(medical_record_id) references medical_record(medical_record_id),
add foreign key(medicine_id) references medicine(medicine_id);

alter table donation
add foreign key(txn_id) references payment(txn_id),
add foreign key(subscription_id) references sponsorship(subscription_id),
add foreign key(org_id) references organization(org_id);

alter table sponsorship_tier
add foreign key(org_id) references organization(org_id);

alter table sponsorship
add foreign key(org_id) references organization(org_id),
add foreign key(user_id) references user(user_id);

alter table report_rescue
add foreign key(org_id) references organization(org_id);

alter table org_content
add foreign key(org_id) references organization(org_id);

alter table org_feedback
add foreign key(org_id) references organization(org_id);

alter table org_merch_item
add foreign key(org_id) references organization(org_id);

alter table merch_purchase
add foreign key(user_id) references user(user_id);

alter table merch_purchase_item
add foreign key(org_id) references organization(org_id),
add foreign key(order_id) references merch_purchase(order_id);

