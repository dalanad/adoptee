use adoptee;
START TRANSACTION;
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`, `about`, `about_photo`, `rating`) 
VALUES ('Pet Haven', '0112345678', 'No. 58', '5th Lane', 'Battaramulla', 'Help an animal in need', "/assets/images/org/PetHaven.jpeg", 'Pet Haven is a 
nonprofit organization that finds homes for abandoned cats and dogs and improves chances of adoption. We conduct clinics, adoption days and events to 
raise awareness, free of charge', '/assets/images/org/about1.jpg', 5);
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`, `about`, `about_photo`, `rating`) 
VALUES ('Animal Shelter', '0334567891', 'No.14/A', 'Temple Road', 'Colombo 8', 'Save a Pet', "/assets/images/org/AnimalShelter.png", 'Animal Shelter is a 
nonprofit organization that finds homes for abandoned cats and dogs and improves chances of adoption. We conduct clinics, adoption days and events to 
raise awareness, free of charge',  '/assets/images/org/about2.jpg', 2.4);
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`, `about`, `about_photo`, `rating`) 
VALUES ('Animal Welfare Centre', '0114567891', 'No. 120', 'Circular Road', 'Dehiwala', 'Give a pet a home', "/assets/images/org/AnimalWelfareCentre.png", 
'Animal Welfare Center is a nonprofit organization that finds homes for abandoned cats and dogs and improves chances of adoption. We conduct clinics, 
adoption days and events to raise awareness, free of charge', '/assets/images/org/about3.png', 4);

 
INSERT INTO `org_content` (`org_id`, `heading`, `description`, `photos`)
VALUES ('1', 'Clinic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', '["/assets/images/org/clinic.jpg"]'),
  ('1', 'Vaccination Program', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', '["/assets/images/org/KittenVaccination.jpg"]'),
  ('2', 'Volunteer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', '["/assets/images/org/volunteer.jpg"]'),
  ('2', 'Awareness Program', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', '["/assets/images/org/awareness.jpg"]'),
  ('3', 'Adoption Day', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', '["/assets/images/org/adoption.jpg"]'),
 ('3', 'Feeding Strays', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', '["/assets/images/org/StrayFeeding2.jpg"]');
 
INSERT INTO `sponsorship_tier` (`org_id`, `name`, `amount`, `recurring_days`, `description`)
VALUES ('1','Gold',5000.00,'30','Funds are allocated for veterinary needs'),
('1','Silver',2500.00,'30','Funds are allocated for veterinary needs'),
('1','Bronze',1000.00,'30','Funds are allocated for food'),
('2','Medical',5000.00,'30','Funds are allocated for veterinary needs'),
('3','Basic',2000.00,'30','Funds are allocated for food');

INSERT INTO `animal` ( `type`, `name`, `gender`, `dob`, `color`,`photo`) VALUES
('Dog', 'Tigger', 'Male',   '2015-07-01', '["Brown"]','/assets/data/dogs/1.jpg'),
('Dog', 'Leo',    'Male',   '2016-01-15', '["Orange"]','/assets/data/dogs/2.jpg'),
('Dog', 'Oliver', 'Female', '2020-10-06', '["White"]','/assets/data/dogs/3.jpg'),
('Dog', 'Milo',   'Female', '2020-02-10', '["Golden Brown"]','/assets/data/dogs/4.jpg'),
('Dog', 'Simba',  'Male',   '2015-10-01', '["White", "Brown"]','/assets/data/dogs/5.jpg'),
('Dog', 'Luna',   'Female', '2017-10-01', '["Black", "Brown"]','/assets/data/dogs/6.jpg'),
('Dog', 'Riley',  'Male',   '2014-10-01', '["Grey"]','/assets/data/dogs/7.jpg'),
('Dog', 'Nala',   'Female', '2015-10-01', '["Orange"]','/assets/data/dogs/8.jpg'),
('Dog', 'Duke',   'Male',   '2015-10-01', '["Grey"]','/assets/data/dogs/9.jpg'),
('Dog', 'Bear',   'Male',   '2013-10-01', '["Grey"]','/assets/data/dogs/10.jpg'),
('Cat', 'Sophie', 'Female', '2015-10-01', '["Grey"]','/assets/data/dogs/11.jpg'),
('Dog', 'Oliver', 'Male',   '2010-10-01', '["White"]','/assets/data/dogs/12.jpg'),
('Dog', 'Lucy',   'Male',   '2012-10-01', '["Grey"]','/assets/data/dogs/13.jpg'),
('Dog', 'Max',    'Male',   '2011-10-01', '["Grey"]','/assets/data/dogs/14.jpg'),
('Dog', 'Bailey', 'Female', '2015-10-01', '["White"]','/assets/data/dogs/15.jpg'),
('Dog', 'Daisy',  'Female', '2015-10-01', '["Grey"]','/assets/data/dogs/16.jpg'),
('Dog', 'Cooper', 'Male',   '2017-10-01', '["Grey"]','/assets/data/dogs/17.jpg'),
('Dog', 'Chloe',  'Female', '2015-10-01', '["Grey"]','/assets/data/dogs/18.jpg'),
('Dog', 'Jack',   'Male',   '2018-10-01', '["Black"]','/assets/data/dogs/19.jpg'),
('Dog', 'Duke',   'Male',   '2019-10-01', '["Grey"]','/assets/data/dogs/20.jpg'),
('Cat', 'Tom',    'Male',   '2013-10-01', '["Black", "Orange", "White"]','/assets/data/cats/1.jpg'),
('Cat', 'Otis',   'Male',   '2013-10-01', '["Orange", "Black"]','/assets/data/cats/2.jpg'),
('Cat', 'Benny',  'Male',   '2013-10-01', '["Black", "White"]','/assets/data/cats/3.jpg'),
('Cat', 'Frank',  'Male',   '2013-10-01', '["Grey"]','/assets/data/cats/4.jpg'),
('Cat', 'Garfield','Male',   '2013-10-01', '["Grey", "White", "Black"]','/assets/data/cats/5.jpg'),
('Cat', 'Penny',  'Female', '2013-10-01', '["Grey"]','/assets/data/cats/6.jpg'),
('Cat', 'Lily',   'Female', '2013-10-01', '["Grey"]','/assets/data/cats/7.jpg'),
('Cat', 'Rosie',  'Female', '2013-10-01', '["Grey"]','/assets/data/cats/8.jpg'),
('Cat', 'Maggie', 'Female', '2013-10-01', '["Grey"]','/assets/data/cats/9.jpg'),
('Cat', 'Nova',   'Female', '2013-10-01', '["Grey"]','/assets/data/cats/10.jpg');

INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`, `email_verified`, `telephone_verified`) VALUES
('Dr. Weerasinghe', 'doctor@example.com', '0761236547', 'No 129/A, Temple Lane, Gampaha', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW',1, 1),
('Ovini Medagedara', 'orguser@example.com', '0761236547', 'No. 58, 5th Lane, Battaramulla', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Hiruni Dahanayake', 'user@example.com', '0761236547', 'No 14/2, Flower Street, Colombo 07', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Dalana Pasindu', 'user2@example.com', '0761236547', 'No 65, 3rd Lane, Dehiwala', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 0, 0),
('Dr. Rathnayake', 'doctor2@example.com', '0761236547', 'No 79/A, Circular Road, Kandy', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW',1, 1),
('Tharani Perera', 'admin1@example.com', '0761236547', 'No. 58, 5th Lane, Battaramulla', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1);

INSERT INTO `notifications` (`notif_id`, `user_id`, `title`, `message` ) 
VALUES (NULL, '3',  'Vaccination Reminder', 'Your pet Tina needs to be vaccinated by 10-10-2021'  ), 
(NULL, '3', 'Adoption Request Update', 'Your request to adopt Tigger has been accepted' );

INSERT INTO `org_user` (`user_id`, `org_id`, `role`) VALUES ('2', '1', 'NORMAL'), ('6', '1', 'ADMIN');

INSERT INTO `org_feedback` (`org_id`, `user_id`, `living_conditions`, `healthcare`, `rescue_response`, `adoptions`, `resource_allocation`, `comments`, `name`, `email`) 
       VALUES ('1', '2', '3', '4', '3', '4', '3', 'Good Work Keep Up', '1', '1'),
       ('1', '3', '2', '4', '2', '3', '4', 'Fast Response to Rescue', '1', '1'),
       ('1', '1', '3', '2', '1', '2', '1', 'Great', '1', '1');

INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`, `user_id`, `photos`) VALUES 
('1', 'Active and loves cuddles, vaccinated', '2021-08-31', 'LISTED', NULL, '1', NULL, '["/assets/data/dogs/1a.jpg","/assets/data/dogs/1b.jpg","/assets/data/dogs/1c.jpg"]'),
('21', 'Playful and a joy to be around, weaned', '2021-08-26', 'LISTED', NULL, '3', NULL, '["/assets/data/cats/1a.jpg","/assets/data/cats/1b.jpg","/assets/data/cats/1c.jpg"]'),
('2', 'Loves to sleep with his favorite toy, vaccinated', '2021-09-01', 'LISTED', NULL, '2', NULL, '["/assets/data/dogs/2a.jpg","/assets/data/dogs/2b.jpg","/assets/data/dogs/2c.jpg"]'),
('3', 'jade-green eyes, not vaccinated','2021-09-01', 'LISTED', NULL, '1',NULL, '["/assets/data/dogs/3a.jpg","/assets/data/dogs/3b.jpg","/assets/data/dogs/3c.jpg"]'),
('22', 'Playful and a joy to be around, vaccinated', '2021-08-26', 'LISTED', NULL, '2',NULL, '["/assets/data/cats/2a.jpg","/assets/data/cats/2b.jpg","/assets/data/cats/2c.jpg"]'),
('4', 'Playful and affectionate, vaccinated', '2021-08-26', 'ADOPTED', '2021-09-03', '1',3, '["/assets/data/dogs/4a.jpg","/assets/data/dogs/4b.jpg"]'),
('5', 'Playful and active, vaccinated', '2021-08-26', 'LISTED', NULL, '2',NULL, '["/assets/data/dogs/5a.jpg","/assets/data/dogs/5b.jpg","/assets/data/dogs/5c.jpg"]'),
('25', 'Healthy and a joy to be around, vaccinated', '2021-08-26', 'ADOPTED', '2021-01-14', '2', 3, '["/assets/data/cats/5a.jpg","/assets/data/cats/5b.jpg","/assets/data/cats/5c.jpg"]'),
('6', 'Loves cuddles and needs attention, vaccinated', '2021-08-26', 'LISTED', NULL, '3', NULL, '["/assets/data/dogs/6a.jpg","/assets/data/dogs/6b.jpeg","/assets/data/dogs/6c.jpg"]'),
('23', 'Independent and friendly, vaccinated', '2021-08-26', 'LISTED', NULL, '3',NULL, '["/assets/data/cats/3a.png","/assets/data/cats/3b.jpg","/assets/data/cats/3c.jpg"]'),
('15', 'Has tiny, hedgehog paws, not vaccinated', '2021-09-02', 'LISTED', NULL, '1',NULL, '["/assets/data/dogs/15a.jpg","/assets/data/dogs/15b.jpg","/assets/data/dogs/15c.jpg"]');

INSERT INTO `user_pet`(`animal_id`, `user_id`, `status`)
VALUES ('10','3',"ACTIVE"), ('9', '3',"ACTIVE"), ('8', '2',"ACTIVE"), ('7', '3',"ACTIVE"), ('6', '2',"ACTIVE"), ('5', '4',"ACTIVE"), 
       ('4', '3',"ACTIVE"), ('1', '3',"ACTIVE"), ('2', '2',"ACTIVE");

INSERT INTO `doctor` (`user_id`, `reg_no`, `telephone_fixed`, `credentials`, `proof_image`) 
VALUES (1, '0778985654', '0112136545', 'B.V.Sc.(Sri Lanka)', '["/uploads/1630599314_63.png"]'),
 (5, '0748345654', '0112136545', 'B.V.Sc.(Sri Lanka)', '["/uploads/1630599314_64.png"]');

INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`,  `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photos`) 
VALUES ('1', NULL, 'Dog', 'Injured Leg - Emergemcy.',  current_timestamp(), '0761236547', 'Anuradhapura', POINT(6.8929, 79.9187), 'RESCUED', '["/assets/data/dogs/10.jpg"]');
INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`,  `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photos`) 
VALUES ('2', NULL, 'Cat', 'Malnutritioned - Need Immediate Care.',   current_timestamp(), '0761236547', 'Anuradhapura', POINT(6.8999, 79.9167), 'PENDING', '["/assets/data/cats/8.jpg"]');
INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`,  `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photos`) 
VALUES ('3', NULL, 'Calf', 'Have got hit by a vehicle - Emergency',   current_timestamp(), '0771234567', 'Anuradhapura', POINT(6.8969, 79.9137), 'PENDING', '["/assets/data/cats/9.jpg"]');

INSERT INTO `rescued_animal`(`animal_id`,`report_id`,`rescued_date`)
VALUES ('10', '1', '2021-08-28'), ('11', '2', '2021-08-30');

 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('1', '3', '1', '2021-08-01', 'PENDING', '1', 'The dog that I already have is easy going and bond well with other animals.', '1', 'Used to pets');
 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('2', '4', '1', '2021-09-02', 'PENDING', '0', '', '1', 'Used to pets');
 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('3', '4', '1', '2021-09-12', 'ADOPTED', '0', '', '1', 'Used to pets');

 INSERT INTO `consultation` ( `consultation_date`, `consultation_time`, `animal_id`, `doctor_user_id`, `user_id`, `status`, `type`, `payment_txn_id`) 
 VALUES 
 ('2021-10-28', '10:30:00', '10', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-10-28', '11:30:00', '9', '1', '3', 'PENDING', 'LIVE', NULL),
 ('2021-10-30', '12:30:00', '8', '1', '2', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-10-30', '13:30:00', '7', '1', '3', 'ACCEPTED', 'LIVE', NULL),
 ('2021-10-30', '14:30:00', '6', '1', '2', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-10-30', '11:00:00', '5', '1', '4', 'ACCEPTED', 'LIVE', NULL),
 ('2021-11-04', '12:00:00', '4', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-11-07', '13:00:00', '1', '1', '3', 'ACCEPTED', 'LIVE', NULL),
 ('2021-11-08', '09:00:00', '2', '1', '2', 'COMPLETED', 'ADVISE', NULL),
 ('2021-11-08', '09:30:00', '2', '1', '2', 'COMPLETED', 'LIVE', NULL),
 ('2021-11-03', '10:00:00', '5', '1', '4', 'COMPLETED', 'ADVISE', NULL),
 ('2021-11-02', '12:00:00', '6', '1', '2', 'COMPLETED', 'ADVISE', NULL),
 ('2021-11-01', '13:00:00', '7', '1', '3', 'COMPLETED', 'ADVISE', NULL)
 ;


 INSERT INTO `consultation_schedule` (`doctor_user_id`, `day_of_week`, `time_slot`, `charge`) VALUES
(1, 0, '08:00:00', 1000),
(1, 0, '08:30:00', 1000),(1, 0, '09:00:00', 1000),(1, 0, '09:30:00', 1000),(1, 2, '09:30:00', 1000),(1, 2, '10:00:00', 1000),(1, 2, '10:30:00', 1000),
(1, 2, '11:00:00', 1000),(1, 2, '11:30:00', 1000),(1, 4, '08:30:00', 1000),(1, 4, '09:00:00', 1000),(1, 4, '09:30:00', 1000),(1, 4, '10:00:00', 1000),
(1, 4, '10:30:00', 1000),(1, 5, '10:00:00', 1000),(1, 5, '10:30:00', 1000),(1, 5, '11:00:00', 1000),(1, 5, '11:30:00', 1000),(1, 5, '12:00:00', 1000),
(1, 5, '12:30:00', 1000),(1, 5, '13:00:00', 1000),(1, 5, '18:00:00', 1000),(1, 5, '18:30:00', 1000),(1, 5, '19:00:00', 1000),(1, 5, '19:30:00', 1000),
(1, 5, '20:00:00', 1000),(1, 5, '20:30:00', 1000),(1, 6, '10:00:00', 1000),(1, 6, '10:30:00', 1000),(1, 6, '11:00:00', 1000),(1, 6, '11:30:00', 1000),
(1, 6, '12:00:00', 1000),(1, 6, '12:30:00', 1000),(1, 6, '13:00:00', 1000),(1, 6, '18:00:00', 1000),(1, 6, '18:30:00', 1000),(1, 6, '19:00:00', 1000),
(1, 6, '19:30:00', 1000),(1, 6, '20:00:00', 1000),(1, 6, '20:30:00', 1000),
(5, 0, '08:30:00', 1000),(5, 0, '09:00:00', 1000),(5, 0, '09:30:00', 1000),(5, 2, '09:30:00', 1000),(5, 2, '10:00:00', 1000),(5, 2, '10:30:00', 1000),
(5, 2, '11:00:00', 1000),(5, 2, '11:30:00', 1000),(5, 4, '08:30:00', 1000),(5, 4, '09:00:00', 1000),(5, 4, '09:30:00', 1000),(5, 4, '10:00:00', 1000),
(5, 4, '10:30:00', 1000),(5, 5, '10:00:00', 1000),(5, 5, '10:30:00', 1000),(5, 5, '11:00:00', 1000),(5, 5, '11:30:00', 1000),(5, 5, '12:00:00', 1000),
(5, 5, '12:30:00', 1000),(5, 5, '13:00:00', 1000),(5, 5, '18:00:00', 1000),(5, 5, '18:30:00', 1000),(5, 5, '19:00:00', 1000),(5, 5, '19:30:00', 1000),
(5, 5, '20:00:00', 1000),(5, 5, '20:30:00', 1000),(5, 6, '10:00:00', 1000),(5, 6, '10:30:00', 1000),(5, 6, '11:00:00', 1000),(5, 6, '11:30:00', 1000),
(5, 6, '12:00:00', 1000),(5, 6, '12:30:00', 1000),(5, 6, '13:00:00', 1000),(5, 6, '18:00:00', 1000),(5, 6, '18:30:00', 1000),(5, 6, '19:00:00', 1000),
(5, 6, '19:30:00', 1000),(5, 6, '20:00:00', 1000),(5, 6, '20:30:00', 1000);

INSERT INTO `consultation_message` (`consultation_id`,  `created_at`, `sender`, `message`) 
VALUES ('3', CURRENT_TIMESTAMP,   '1', 'How about the water intake ?'), ('3', '2021-09-13 00:00:00',  '3', 'My pet have not eaten much in the recent days'), 
('6', CURRENT_TIMESTAMP,   '1', 'Home treatment advised'), ('2', '2021-09-13 00:00:00',  '1', 'Advised to take prescribed medicine'), 
('5', CURRENT_TIMESTAMP,   '1', 'Prescription given'),('11',CURRENT_TIMESTAMP, '1','Home treatment advised'),
('13',CURRENT_TIMESTAMP,   '1', 'Prescription given');

COMMIT;