use adoptee;
START TRANSACTION;
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`, `about`) 
VALUES ('Pet Haven', '0112345678', 'No. 58', '5th Lane', 'Battaramulla', 'Help an animal in need', 'LOGO', 'Pet Haven is a 
nonprofit organization that finds homes for abandoned cats and dogs and improves chances of adoption. We conduct clinics, adoption days and events to raise awareness, free of charge');
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`, `about`) 
VALUES ('Animal Shelter', '0334567891', 'No.14/A', 'Temple Road', 'Colombo 8', 'Save a Pet', 'LOGO', 'Animal Shelter is a 
nonprofit organization that finds homes for abandoned cats and dogs and improves chances of adoption. We conduct clinics, adoption days and events to raise awareness, free of charge');
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`, `about`) 
VALUES ('Animal Welfare Centre', '0114567891', 'No. 120', 'Circular Road', 'Dehiwala', 'Give a pet a home', 'LOGO', 'Animal Welfare Center is a 
nonprofit organization that finds homes for abandoned cats and dogs and improves chances of adoption. We conduct clinics, adoption days and events to raise awareness, free of charge');

 
INSERT INTO `org_content` (`org_id`, `heading`, `description`, `photo`)
VALUES ('1', 'Clinic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO'),
  ('1', 'Vaccination Program', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO'),
  ('2', 'Volunteer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO'),
  ('3', 'Adoption Day', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO');
 
INSERT INTO `sponsorship_tier` (`org_id`, `name`, `amount`, `recurring_days`, `description`)
VALUES ('1','Gold',5000.00,'30','Funds are allocated for veterinary needs'),
('1','Silver',2500.00,'30','Funds are allocated for veterinary needs'),
('1','Bronze',1000.00,'30','Funds are allocated for food'),
('2','Medical',5000.00,'30','Funds are allocated for veterinary needs'),
('3','Basic',2000.00,'30','Funds are allocated for food');

INSERT INTO `animal` ( `type`, `name`, `gender`, `dob`, `color`,`photo`) VALUES
('Dog', 'Tigger', 'Male',   '2021-07-01', 'Black','/assets/data/dogs/1.jpg'),
('Dog', 'Leo',    'Male',   '2016-01-15', 'Orange','/assets/data/dogs/2.jpg'),
('Dog', 'Oliver', 'Female', '2021-12-16', 'White','/assets/data/dogs/3.jpg'),
('Dog', 'Milo',   'Female', '2020-02-10', 'Golden Brown','/assets/data/dogs/4.jpg'),
('Dog', 'Simba',  'Male',   '2015-10-01', 'Grey','/assets/data/dogs/5.jpg'),
('Dog', 'Luna',   'Female', '2017-10-01', 'Grey','/assets/data/dogs/6.jpg'),
('Dog', 'Riley',  'Male',   '2014-10-01', 'Grey','/assets/data/dogs/7.jpg'),
('Dog', 'Nala',   'Female', '2015-10-01', 'Orange','/assets/data/dogs/8.jpg'),
('Dog', 'Duke',   'Male',   '2015-10-01', 'Grey','/assets/data/dogs/9.jpg'),
('Dog', 'Bear',   'Male',   '2013-10-01', 'Grey','/assets/data/dogs/10.jpg'),
('Cat', 'Sophie', 'Female', '2015-10-01', 'Grey','/assets/data/dogs/11.jpg'),
('Dog', 'Oliver', 'Male',   '2010-10-01', 'White','/assets/data/dogs/12.jpg'),
('Dog', 'Lucy',   'Male',   '2012-10-01', 'Grey','/assets/data/dogs/13.jpg'),
('Dog', 'Max',    'Male',   '2011-10-01', 'Grey','/assets/data/dogs/14.jpg'),
('Dog', 'Bailey', 'Female', '2015-10-01', 'Golden Brown','/assets/data/dogs/15.jpg'),
('Dog', 'Daisy',  'Female', '2015-10-01', 'Grey','/assets/data/dogs/16.jpg'),
('Dog', 'Cooper', 'Male',   '2017-10-01', 'Grey','/assets/data/dogs/17.jpg'),
('Dog', 'Chloe',  'Female', '2015-10-01', 'Grey','/assets/data/dogs/18.jpg'),
('Dog', 'Jack',   'Male',   '2018-10-01', 'Black','/assets/data/dogs/19.jpg'),
('Dog', 'Duke',   'Male',   '2019-10-01', 'Grey','/assets/data/dogs/20.jpg'),
('Cat', 'Tom',    'Male',   '2013-10-01', 'Grey','/assets/data/cats/1.jpg'),
('Cat', 'Otis',   'Male',   '2013-10-01', 'Grey','/assets/data/cats/2.jpg'),
('Cat', 'Benny',  'Male',   '2013-10-01', 'Grey','/assets/data/cats/3.jpg'),
('Cat', 'Frank',  'Male',   '2013-10-01', 'Grey','/assets/data/cats/4.jpg'),
('Cat', 'Garfield','Male',   '2013-10-01', 'Grey','/assets/data/cats/5.jpg'),
('Cat', 'Penny',  'Female', '2013-10-01', 'Grey','/assets/data/cats/6.jpg'),
('Cat', 'Lily',   'Female', '2013-10-01', 'Grey','/assets/data/cats/7.jpg'),
('Cat', 'Rosie',  'Female', '2013-10-01', 'Grey','/assets/data/cats/8.jpg'),
('Cat', 'Maggie', 'Female', '2013-10-01', 'Grey','/assets/data/cats/9.jpg'),
('Cat', 'Nova',   'Female', '2013-10-01', 'Grey','/assets/data/cats/10.jpg');

INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`) VALUES 
('1', 'Active and loves cuddles, vaccinated', '2021-08-31', 'ADOPTED', '2021-09-03', '1'),
('21', 'Playful and a joy to be around, weaned', '2021-08-26', 'LISTED', NULL, '3'),
('2', 'Loves to sleep with his favorite toy, vaccinated', '2021-09-01', 'LISTED', NULL, '2'),
('3', 'jade-green eyes not vaccinated','2021-09-01', 'LISTED', NULL, '1'),
('22', 'Playful and a joy to be around, vaccinated', '2021-08-26', 'LISTED', NULL, '2'),
('4', 'Playful and affectionate, vaccinated', '2021-08-26', 'LISTED', NULL, '1'),
('5', 'Playful and active, vaccinated', '2021-08-26', 'LISTED', NULL, '2'),
('25', 'Healthy and a joy to be around, vaccinated', '2021-08-26', 'LISTED', NULL, '2'),
('6', 'Loves cuddles and needs attention, vaccinated', '2021-08-26', 'LISTED', NULL, '3'),
('23', 'Independent and friendly, vaccinated', '2021-08-26', 'LISTED', NULL, '3'),
('15', 'Has tiny, hedgehog paws, not vaccinated', '2021-09-02', 'LISTED', NULL, '1');


INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`, `email_verified`, `telephone_verified`) VALUES
('Dr. Weerasinghe', 'doctor@example.com', '0761236547', 'doctor address', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW',1, 1),
('Ms. Org User', 'orguser@example.com', '0761236547', 'user address', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Mr. Reg. User', 'user@example.com', '0761236547', 'user address', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Mr. Reg. User2', 'user2@example.com', '0761236547', 'user address', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 0, 0);

INSERT INTO `user_pet`(`animal_id`, `user_id`) VALUES(5,3),(6,3),(7,3),(8,4),(9,4); 

INSERT INTO `org_user` (`user_id`, `org_id`, `role`) VALUES ('2', '1', 'NORMAL');

INSERT INTO `doctor` (`user_id`, `reg_no`, `telephone_fixed`, `credentials`, `proof_image`) 
VALUES (1, '0778985654', '0112136545', 'B.V.Sc.(Sri Lanka)', '["/uploads/1630599314_63.png"]') ;

INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`, `date_reported`, `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photo`) 
VALUES ('1', NULL, 'Dog', 'Injured Leg - Emergemcy.', '2021-08-27', current_timestamp(), '0761236547', 'Anuradhapura', NULL, 'RESCUED', '');
INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`, `date_reported`, `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photo`) 
VALUES ('2', NULL, 'Cat', 'Malnutritioned - Need Immediate Care.', '2021-09-10', current_timestamp(), '0761236547', 'Anuradhapura', NULL, 'PENDING', '');
INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`, `date_reported`, `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photo`) 
VALUES ('3', NULL, 'Calf', 'Have got hit by a vehicle - Emergency', '2021-09-14', current_timestamp(), '0771234567', 'Anuradhapura', NULL, 'PENDING', '');

INSERT INTO `rescued_animal`(`animal_id`,`report_id`,`rescued_date`)
VALUES ('10', '1', '2021-08-28'), ('11', '2', '2021-08-30');

 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('1', '3', '1', '2021-08-01', 'PENDING', '1', 'The dog that I already have is easy going and bond well with other animals.', '1', 'Used to pets');
 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('2', '3', '1', '2021-09-02', 'REJECTED', '0', '', '1', 'Used to pets');
 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('3', '3', '1', '2021-09-12', 'ADOPTED', '0', '', '1', 'Used to pets');

 INSERT INTO `consultation` ( `consultation_date`, `consultation_time`, `animal_id`, `doctor_user_id`, `user_id`, `status`, `type`, `payment_txn_id`) 
 VALUES ('2021-09-08', '10:30:00', '4', '1', '3', 'PENDING', 'LIVE', NULL),
 ('2021-09-08', '8:30:00', '5', '1', '2', 'COMPLETED', 'LIVE', NULL),
 ('2021-09-18', '10:30:00', '10', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-18', '11:30:00', '9', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-18', '12:30:00', '8', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-18', '13:30:00', '7', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-18', '14:30:00', '6', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-18', '11:00:00', '5', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-18', '12:00:00', '4', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-18', '13:00:00', '1', '1', '3', 'ACCEPTED', 'ADVISE', NULL),
 ('2021-09-19', '09:00:00', '2', '1', '2', 'COMPLETED', 'ADVISE', NULL),
 ('2021-09-19', '11:00:00', '3', '1', '3', 'ACCEPTED', 'LIVE', NULL),
 ('2021-09-19', '09:30:00', '2', '1', '2', 'COMPLETED', 'ADVISE', NULL),
 ('2021-09-19', '10:00:00', '5', '1', '3', 'COMPLETED', 'ADVISE', NULL),
 ('2021-09-19', '12:00:00', '6', '1', '3', 'COMPLETED', 'ADVISE', NULL),
 ('2021-09-19', '13:00:00', '7', '1', '3', 'COMPLETED', 'ADVISE', NULL)
 ;


 INSERT INTO `consultation_schedule` (`doctor_user_id`, `day_of_week`, `time_slot`, `available`) VALUES
(1, 0, '08:00:00', 1),
(1, 0, '08:30:00', 1),
(1, 0, '09:00:00', 1),
(1, 0, '09:30:00', 1),
(1, 2, '09:30:00', 1),
(1, 2, '10:00:00', 1),
(1, 2, '10:30:00', 1),
(1, 2, '11:00:00', 1),
(1, 2, '11:30:00', 1),
(1, 4, '08:30:00', 1),
(1, 4, '09:00:00', 1),
(1, 4, '09:30:00', 1),
(1, 4, '10:00:00', 1),
(1, 4, '10:30:00', 1),
(1, 5, '10:00:00', 1),
(1, 5, '10:30:00', 1),
(1, 5, '11:00:00', 1),
(1, 5, '11:30:00', 1),
(1, 5, '12:00:00', 1),
(1, 5, '12:30:00', 1),
(1, 5, '13:00:00', 1),
(1, 5, '18:00:00', 1),
(1, 5, '18:30:00', 1),
(1, 5, '19:00:00', 1),
(1, 5, '19:30:00', 1),
(1, 5, '20:00:00', 1),
(1, 5, '20:30:00', 1),
(1, 6, '10:00:00', 1),
(1, 6, '10:30:00', 1),
(1, 6, '11:00:00', 1),
(1, 6, '11:30:00', 1),
(1, 6, '12:00:00', 1),
(1, 6, '12:30:00', 1),
(1, 6, '13:00:00', 1),
(1, 6, '18:00:00', 1),
(1, 6, '18:30:00', 1),
(1, 6, '19:00:00', 1),
(1, 6, '19:30:00', 1),
(1, 6, '20:00:00', 1),
(1, 6, '20:30:00', 1);

INSERT INTO `consultation_message` (`consultation_id`,  `created_at`, `sender`, `message`) 
VALUES ('3', CURRENT_TIMESTAMP,   '1', 'testestset'), ('3', '2021-09-13 00:00:00',  '3', 'Hello 1234567'), ('14', CURRENT_TIMESTAMP,   '1', 'Home treatment advised'), ('15', '2021-09-13 00:00:00',  '1', 'Advised to take prescribed medicine'), ('16', CURRENT_TIMESTAMP,   '1', 'Prescription given');

COMMIT;