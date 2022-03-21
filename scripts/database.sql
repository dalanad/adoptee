
DROP DATABASE IF EXISTS adoptee;

-- charset is set to utf8mb4_unicode_ci to support UNICODE such as emoji

CREATE DATABASE adoptee DEFAULT CHARSET = utf8mb4 DEFAULT COLLATE = utf8mb4_unicode_ci;

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
    proof_image JSON,
    advise_charge int(10) default 500,
    live_charge int(10) default 1000
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
    about varchar(500),
    about_photo varchar(50),
    rating decimal(7,1),
    location_coordinates POINT
);

create table org_user (
    user_id int(10) ,
    org_id  int(10),
    role enum('ADMIN','NORMAL') not null default 'NORMAL',
    status enum('ACTIVE','DISABLED') not null default 'ACTIVE',
    primary key(user_id,org_id)
);

create table routine_updates (
    animal_id int(10),
    user_id int(10),
    type enum('HEALTH', 'NUTRITION', 'OTHER'),
    description varchar(100) ,
    photo varchar(100),
    update_date date
);

create table animal (
    animal_id int(10) AUTO_INCREMENT not null,
    type varchar(10),
    other varchar(10), 
    name varchar(50),
    gender enum('MALE', 'FEMALE', 'UNKNOWN') default 'UNKNOWN',
    dob date,
    color JSON,
    photo varchar(100),
    primary key(animal_id)
);

create table animal_for_adoption (
    animal_id int(10) not null,
    description varchar(1000),
    date_listed date,
    status enum('LISTED','ADOPTED', 'DELETED') not null default 'LISTED',
    date_adopted date,
    dewormed boolean,
    org_id int(10),
    user_id int(10),
    photos JSON,
    rescue_report_id int(10),
    primary key(animal_id)
);

create table animal_vaccines (
    animal_id int(10) not null,
    anti_rabies date,
    dhl date,
    parvo date,
    tricat date,
    anti_rabies_booster date,
    dhl_booster date,
    parvo_booster date,
    tricat_booster date,
    vacc_proof JSON,
    primary key(animal_id)
);

create table rescued_animal (
    org_id  int(10),
    report_id int(10) primary key,
    rescued_date timestamp DEFAULT CURRENT_TIMESTAMP
);

create table user_pet (
    animal_id int(10) ,
    user_id int(10),
    status enum("ACTIVE","REMOVED"),
    dewormed boolean,
    primary key (animal_id),
    unique (animal_id, user_id)
);

create table consultation (
    consultation_id int(10) auto_increment primary key, -- should we add a primary key ?
    consultation_date date not null,
    consultation_time time not null,
    animal_id int(10) not null,
    doctor_user_id int(10),
    user_id int(10),
    status enum('CANCELLED','PENDING','ACCEPTED','COMPLETED','EXPIRED') not null default 'PENDING', 
    type enum('LIVE','ADVISE') not null default 'ADVISE',
    payment_txn_id varchar(100),
    doctor_rating int(5),
    meeting_id varchar(50) default '7ewh-ve15-16uf'
);

create table consultation_schedule (
    doctor_user_id int(10) not null,
    day_of_week int(1),
    time_slot time not null,
    charge int not null,
    primary key (doctor_user_id, day_of_week, time_slot) 
);

alter table consultation   
  add unique key `consultation_doctor_availability` (doctor_user_id, type, consultation_date, consultation_time); 
-- cancelled sessions on same time ?

create table consultation_message (
     consultation_id int(10),
     created_at timestamp DEFAULT CURRENT_TIMESTAMP,
     medical_record_id int(10),
     attachments JSON,
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
    dose varchar(20),
    duration varchar(20),
    direction varchar(20),
    medicine_id int (10)

);

create table medicine (
    medicine_id int (10) auto_increment primary key,
    name varchar(100),
    doctor_id int(10) not null
);

create table payment (
    txn_id varchar(100) primary key,
    amount float,
    txn_time timestamp default CURRENT_TIMESTAMP,
    user int(10) not null,
    status enum('PAID','REFUNDED') DEFAULT 'PAID',
    type enum('PAYMENT','WITHDRAWAL') default 'PAYMENT'
);

create table donation (
    donation_id int(10) primary key AUTO_INCREMENT,
    org_id int(10),
    txn_id varchar(100),
    name varchar(50),
    subscription_id int(10)
);

create table sponsorship_tier(
  org_id int(10),
  name varchar(50),
  amount int(10) not null,
  recurring_days int(10) not null,
  description varchar(500),
  status enum('ACTIVE','INACTIVE') not null default 'ACTIVE',
  primary key(org_id,name)
);

create table sponsorship (
  subscription_id int(10) AUTO_INCREMENT primary key,
  org_id int(10),
  name varchar(50), -- subscription tier name
  user_id int(10),
  amount_at_subscription int(10) not null,
  start_date date not null,
  end_date date,
  status enum('ACTIVE','CANCELLED') not null default 'ACTIVE'
);

create table report_rescue(
    org_id int(10),
    report_id int(10) AUTO_INCREMENT primary key,
    type varchar(50), 
    description varchar(200),
    time_reported timestamp DEFAULT CURRENT_TIMESTAMP,
    contact_number int(10),
    location varchar(100) not null,
    location_coordinates POINT,
    status enum('PENDING', 'IN PROGRESS','RESCUED') not null default 'PENDING',
    accepted_date timestamp DEFAULT CURRENT_TIMESTAMP,
    photos JSON not null    
);

create table org_content (
    item_id int(10) AUTO_INCREMENT primary key,
    org_id int(10),
    created_time timestamp  DEFAULT CURRENT_TIMESTAMP,
    heading varchar(50),
    description varchar(2000),
    photos JSON not null
);

create table org_feedback (
    org_id int(10),
    user_id int(10),
    created_time timestamp  DEFAULT CURRENT_TIMESTAMP,
    living_conditions int,
    healthcare int,
    rescue_response int,
    adoptions int,
    resource_allocation int,
    comments varchar(200),
    acknowledged boolean default 0, 
    name boolean default 0, 
    email boolean default 0 
);

create table adoption_request (
    animal_id int(10),
    user_id int(10),
    org_id int(10),
    request_date date,
    status enum('PENDING','ACCEPTED','ADOPTED','REJECTED') not null default 'PENDING',
    has_pets boolean,
    petsafety varchar(100) ,
    children boolean,
    childsafety varchar(100) ,
    primary key(animal_id, user_id)
);

create table notifications (
    notif_id int(10) AUTO_INCREMENT primary key,
    user_id int(10),
    created_at timestamp default CURRENT_TIMESTAMP,
    title varchar(200),
    message varchar(500) not null,
    type enum("SMS","EMAIL","NOTIFICATION") default 'NOTIFICATION',
    sent boolean default false -- whether the sms or email is sent
);

create table vaccines (
    vacine_id int(10) AUTO_INCREMENT primary key,
    name varchar(50) not null,
    type enum("ONE-TIME","RECURRING") not null default "RECURRING",
    inter int(5)   
);

create table animal_vaccinations (
    animal_id int(10),
    vacine_id int(10),
    given_date date,
    primary key(animal_id, vacine_id, given_date)
);

create table breeds (
    breedId int(11) primary key auto_increment,
    type enum("CAT","DOG"),
    breed varchar(20) unique,
    height double,
    weight double,
    life_expectancy int,
    color json,
    photo varchar(200),
    child_friendly varchar(10),
    pet_friendly varchar(200),
    health varchar(200),
    problems varchar(200)
);

alter table notifications
add foreign key(user_id) references user(user_id);

alter table payment
add foreign key(user) references user(user_id);

alter table consultation_schedule
add foreign key(doctor_user_id) references user(user_id);

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

alter table animal_vaccines
add foreign key(animal_id) references animal(animal_id);

alter table rescued_animal
add foreign key(report_id) references report_rescue(report_id),
add foreign key(org_id) references organization(org_id);

alter table user_pet
add foreign key(animal_id) references animal(animal_id),
add foreign key(user_id) references user(user_id);

alter table consultation
add foreign key(user_id) references user(user_id),
add foreign key(animal_id) references animal(animal_id);

-- add foreign key(user_id) references user_pet(user_id),
-- add foreign key(animal_id) references user_pet(animal_id),

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

-- EVENTS
SET GLOBAL event_scheduler="ON";

CREATE EVENT `SEND_VACCINE_REMINDERS` ON SCHEDULE EVERY 1 HOUR ENABLE
DO
BEGIN

    INSERT INTO notifications (message,title,user_id)

    SELECT * FROM (
        SELECT CONCAT('Your pet ', a.name,' needs to be vaccinated with ',
                IF(v.anti_rabies < DATE_SUB(NOW(), INTERVAL 1 YEAR) OR v.anti_rabies_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR),' "Anti-Rabies", ','' ),
                IF(v.dhl < DATE_SUB(NOW(), INTERVAL 1 YEAR) OR v.dhl_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR),' "DHL", ','' ),
                IF(v.parvo < DATE_SUB(NOW(), INTERVAL 1 YEAR) OR v.parvo_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR),' "PARVO", ','' ),
                IF(v.tricat < DATE_SUB(NOW(), INTERVAL 1 YEAR) OR v.tricat_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR),' "TRICAT", ','' )
            ) message,
            'Vaccination Reminder' title,
            up.user_id 
        FROM animal_vaccines v 
            INNER JOIN animal a ON a.animal_id = v.animal_id   
            INNER JOIN user_pet up ON up.animal_id = v.animal_id
        WHERE
            a.animal_id = v.animal_id
        AND (
            v.anti_rabies < DATE_SUB(NOW(), INTERVAL 1 YEAR)
            OR v.dhl < DATE_SUB(NOW(), INTERVAL 1 YEAR)
            OR v.parvo < DATE_SUB(NOW(), INTERVAL 1 YEAR)
            OR v.tricat < DATE_SUB(NOW(), INTERVAL 1 YEAR)
            OR v.anti_rabies_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR)
            OR v.dhl_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR)
            OR v.parvo_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR)
            OR v.tricat_booster < DATE_SUB(NOW(), INTERVAL 1 YEAR)
        )) r 
    WHERE 
    (SELECT count(*) FROM notifications n 
            WHERE n.message = r.message 
            AND n.user_id = r.user_id 
            AND n.created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)) = 0;

END;