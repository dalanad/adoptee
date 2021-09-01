
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
    user_id int(10),
    reg_no varchar(50) primary key,
    telephone_fixed char(10),
    credentials varchar(50),
    proof_image varchar(50)
);

create table organization ( 
    org_id  int(10) AUTO_INCREMENT primary key ,
    name varchar(50) not null ,
    telephone char(10) not null,
    address_line_1 varchar(50)   ,
    address_line_2 varchar(50)  ,
    city varchar(20) ,
    tagline varchar(50),
    logo varchar(50)
);

create table org_user (
    user_id int(10) ,
    org_id  int(10),
    role enum('ADMIN','NORMAL') not null default 'NORMAL',
    primary key(user_id,org_id)
);


create table adoption_request (
    animal_id int(10),
    user_id int(10),
    request_date date,
    approval_date date,
    status enum('PENDING','APPROVED','REJECTED') not null default 'PENDING',
    has_pets boolean,
    petsafety varchar(100) ,
    children boolean,
    childsafety varchar(100) ,
    primary key(animal_id, user_id)
    -- foreign key(org_id) references organization(org_id),
    -- foreign key(animal_id) references animal(animal_id),
    -- foreign key(user_id) references user(user_id)

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
    name varchar(50),
    gender enum('M','F') ,
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
    primary key(animal_id),
    foreign key(animal_id) references animal(animal_id),
    foreign key(org_id) references organization(org_id)
);

create table animal_for_adoption_photos(
    animal_id int(10) not null,
    photo varchar(100) not null, 
    primary key(animal_id, photo),
    foreign key(animal_id) references animal(animal_id)
);

create table rescued_animal (
    report_id int(10),
    animal_id int(10) not null,
    rescued_date date
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


alter table consultation   
  add unique key `consultation_doctor_availability` (doctor_user_id, type, consultation_date, consultation_time); 
-- cancelled sessions on same time ?

create table consulataton_message (
     consultation_id int(10),
     created_at timestamp,
     medical_record_id int(10),
     message varchar(128)
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
    medecine_id int (10)

);

create table medecine (
    medecine_id int (10) auto_increment primary key,
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
  user_id varchar(5),
  amount_at_subscription int(10) not null,
  start_date date,
  end_date date,
  status enum('ACTIVE','CANCELED') not null default 'ACTIVE'
);

create table report_rescue(
    org_id int(10),
    report_id int(10) AUTO_INCREMENT primary key,
    type varchar(50), -- animal type
    description varchar(100),
    time_reported timestamp DEFAULT CURRENT_TIMESTAMP,
    contact_number int(10),
    location varchar(100) not null,
    location_coordinates varchar(100) ,
    status enum('PENDING','ACCTPED','REJECTED','RESCUED') not null default 'PENDING',
    photo varchar(100) not null -- JSON ?
);

create table org_content (
    item_id int(10) AUTO_INCREMENT primary key,
    org_id int(10),
    created_time timestamp  DEFAULT CURRENT_TIMESTAMP,
    description varchar(200),
    photo varchar(200), -- JSON ?
    foreign key(org_id) references organization(org_id)
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
    status enum('CANCELED','SHIPPED','PENDING') not null default 'PENDING',
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


INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`) 
VALUES ('Pet Haven', '0112345678', 'No. 58', '5th Lane', 'Battaramulla', 'Help an animal in need', 'LOGO');

INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`) 
VALUES ('Animal Shelter', '0334567891', 'No.14/A', 'Temple Road', 'Colombo 8', 'Save a Pet', 'LOGO');

INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`) 
VALUES ('Animal Welfare Centre', '0114567891', 'No. 120', 'Circular Road', 'Dehiwala', 'Give a pet a home', 'LOGO');


INSERT INTO `org_content` (`org_id`, `description`, `photo`)
VALUES ('1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod', 'PHOTO');
 INSERT INTO `org_content` (`org_id`, `description`, `photo`)
VALUES ('1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'PHOTO');
