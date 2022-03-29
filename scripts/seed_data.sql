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

 
INSERT INTO `org_content` ( `org_id`, `created_time`, `heading`, `description`, `photos`) VALUES
(1,	'2022-03-27 16:42:55',	'Clinic',	'Rescue and treatment program for street dogs has grown to become one of the most significant components of our work. We offer high standards of Veterinary care for homeless dogs at no charge, which is a much needed service in Sri Lanka considering the large numbers. As our work expanded, the numbers of rescue and treatment requests have also increased exponentially with a monthly estimate of over 1000 calls to the hotline.\n\r\n Each request is assessed by our team and addressed by our veterinarians either in-house, onsite or through hospitalization for more critical cases. Assessments are dependent on several factors. The most important being the consideration of both the physical and mental wellbeing, veterinary advise and the long term welfare of the dog.',	'[\"/assets/images/org/clinic.jpg\"]'),
(1,	'2022-03-28 16:42:55',	'Vaccination Programme',	'Mission Rabies in conjunction with local partner charity Dogstar Foundation ran a pilot vaccination campaign in January 2015 in Negombo, Sri Lanka to demonstrate the effectiveness of Mission Rabies’ working protocols and to establish the feasibility of transferring these to working outside of Sri Lanka.',	'[\"/assets/images/org/KittenVaccination.jpg\"]'),
(2,	'2022-03-26 16:42:55',	'Volunteer',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.',	'[\"/assets/images/org/volunteer.jpg\"]'),
(2,	'2022-03-28 16:42:55',	'Awareness Program',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.',	'[\"/assets/images/org/awareness.jpg\"]'),
(3,	'2022-03-24 16:42:55',	'Adoption Day',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.',	'[\"/assets/images/org/adoption.jpg\"]'),
(3,	'2022-03-28 16:42:55',	'Feeding Strays',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.',	'[\"/assets/images/org/StrayFeeding2.jpg\"]');

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
('Cat', 'Rosie',  'Female', '2013-10-01', '["Grey"]','/assets/data/cats/8.jpg'),
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
('Cat', 'Maggie', 'Female', '2013-10-01', '["Grey"]','/assets/data/cats/9.jpg'),
('Cat', 'Nova',   'Female', '2013-10-01', '["Grey"]','/assets/data/cats/10.jpg'),
('cat', 'Jasper',    'FEMALE',	'2018-04-01',	'[\"Black\"]',	'/assets/data/cats/3.jpg'),
('dog', 'Jasper',    'MALE',	'2017-06-01',	'[\"Black\"]',	'/assets/data/dogs/8.jpg'),
('dog', 'Banjo',     'FEMALE',	'2020-07-01',	'[\"Black\"]',	'/assets/data/dogs/8.jpg'),
('dog', 'Rosie',     'MALE',	'2015-04-01',	'[\"Black\"]',	'/assets/data/dogs/16.jpg'),
('dog', 'Millie',    'MALE',	'2021-05-01',	'[\"Black\"]',	'/assets/data/dogs/10.jpg'),
('dog', 'Millie',    'MALE',	'2021-04-01',	'[\"Black\"]',	'/assets/data/dogs/8.jpg'),
('cat', 'Evie',      'FEMALE',	'2020-03-01',	'[\"Black\"]',	'/assets/data/cats/2.jpg'),
('dog', 'Ziggy',     'MALE',	'2014-06-01',	'[\"Black\"]',	'/assets/data/dogs/5.jpg'),
('dog', 'Coco',      'FEMALE',	'2021-04-01',	'[\"Black\"]',	'/assets/data/dogs/9.jpg'),
('dog', 'Evie',      'FEMALE',	'2016-07-01',	'[\"Black\"]',	'/assets/data/dogs/11.jpg'),
('cat', 'Milo',      'FEMALE',	'2019-03-01',	'[\"Black\"]',	'/assets/data/cats/2.jpg'),
('dog', 'Cleo',      'FEMALE',	'2016-04-01',	'[\"Black\"]',	'/assets/data/dogs/15.jpg'),
('cat', 'Harry',     'FEMALE',	'2017-06-01',	'[\"Black\"]',	'/assets/data/cats/10.jpg'),
('cat', 'Daisy',     'FEMALE',	'2015-05-01',	'[\"Black\"]',	'/assets/data/cats/10.jpg'),
('dog', 'Simba',     'FEMALE',	'2017-05-01',	'[\"Black\"]',	'/assets/data/dogs/18.jpg'),
('dog', 'Stella',    'FEMALE',	'2017-06-01',	'[\"Black\"]',	'/assets/data/dogs/15.jpg'),
('dog', 'Maggie',    'MALE',	'2015-09-01',	'[\"Black\"]',	'/assets/data/dogs/2.jpg'),
('cat', 'Bonnie',    'FEMALE',	'2014-06-01',	'[\"Black\"]',	'/assets/data/cats/2.jpg'),
('dog', 'Roxy',      'FEMALE',	'2015-08-01',	'[\"Black\"]',	'/assets/data/dogs/10.jpg'),
('dog', 'Lexi',      'MALE',	'2019-01-01',	'[\"Black\"]',	'/assets/data/dogs/18.jpg'),
('dog', 'Minnie',    'MALE',	'2015-04-01',	'[\"Black\"]',	'/assets/data/dogs/18.jpg'),
('dog', 'Ziggy',     'MALE',	'2017-06-01',	'[\"Black\"]',	'/assets/data/dogs/8.jpg'),
('dog', 'Rosie',     'FEMALE',	'2020-06-01',	'[\"Black\"]',	'/assets/data/dogs/20.jpg'),
('dog', 'Koda',      'FEMALE',	'2015-06-01',	'[\"Black\"]',	'/assets/data/dogs/19.jpg'),
('cat', 'Tilly',     'MALE',	'2018-09-01',	'[\"Black\"]',	'/assets/data/cats/2.jpg'),
('dog', 'George',    'FEMALE',	'2021-01-01',	'[\"Black\"]',	'/assets/data/dogs/9.jpg'),
('dog', 'Simba',     'MALE',	'2015-01-01',	'[\"Black\"]',	'/assets/data/dogs/18.jpg'),
('dog', 'Zoe',       'FEMALE',	'2021-06-01',	'[\"Black\"]',	'/assets/data/dogs/2.jpg'),
('cat', 'Cooper',    'MALE',	'2020-07-01',	'[\"Black\"]',	'/assets/data/cats/3.jpg');

INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`, `email_verified`, `telephone_verified`) VALUES
('Dr. Weerasinghe', 'doctor@example.com', '0761234567', 'No 129/A, Temple Lane, Gampaha', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW',1, 1),
('Ovini Medagedara', 'orguser@example.com', '0761235674', 'No. 58, 5th Lane, Battaramulla', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Hiruni Dahanayake', 'user@example.com', '0761231234', 'No 14/2, Flower Street, Colombo 07', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Tharani Perera', 'user2@example.com', '0761237654', 'No 65, 3rd Lane, Dehiwala', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Dr. Rathnayake', 'doctor2@example.com', '0761231212', 'No 79/A, Circular Road, Kandy', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW',1, 1),
('Dalana Pasindu', 'admin1@example.com', '0761237766', 'No. 58, 5th Lane, Battaramulla', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Nimasha de Alwis',	       'u1@example.com',	'0723826655',	'No. 73, 4th Lane, Athurigiriya', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Amila Wanniarachchi',	'u2@example.com',	'0719454688',	'No. 74, 6th Lane, Athurigiriya', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Nimesha Tissera',	       'u3@example.com',	'0738788561',	'No. 69, 5th Lane, Athurigiriya', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Sameera Gunathilake',	'u4@example.com',	'0741064439',	'No. 73, 9th Lane, Athurigiriya', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Savindi Abeywickrama',	'u5@example.com',	'0761831104',	'No. 43, 3rd Lane, Athurigiriya', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Sandani Tennakoon',	'u6@example.com',	'0732533598',	'No. 91, 9th Lane, Athurigiriya', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Himasha Alahakoon',	'u7@example.com',	'0773407294',	'No. 55, 8th Lane, Battaramulla', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Samadhi Gunarathne',	'u8@example.com',	'0742727113',	'No. 25, 7th Lane, Battaramulla', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Nuwan Rupasinghe',	       'u9@example.com',	'0715987639',	'No. 13, 5th Lane, Kaduwela', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Navodya Thilakarathne',	'u10@example.com',	'0755796018',	'No. 72, 5th Lane, Kaduwela', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Kalani Tissera',	       'u11@example.com',	'0772513046',	'No. 25, 5th Lane, Kaduwela', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Amila Gunathilake',	'u12@example.com',	'0786855332',	'No. 24, 7th Lane, Malabe', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Sachin Jayaratne',	       'u13@example.com',	'0711075875',	'No. 85, 8th Lane, Malabe', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Fathima Wijesooriya',	'u14@example.com',	'0780452190',	'No. 23, 3rd Lane, Malabe', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Chamath Gunarathna',	'u15@example.com',	'0716544377',	'No. 32, 5th Lane, Malabe', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Nayani Kumarasinghe',	'u16@example.com',	'0777527229',	'No. 74, 5th Lane, Malabe', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Mahesh Gunawardena',	'u17@example.com',	'0715632429',	'No. 47, 6th Lane, Malabe', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Upeksha Cader',	       'u18@example.com',	'0771776611',	'No. 85, 7th Lane, Kottawa', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Chathura Jayawickrama',	'u19@example.com',	'0784338338',	'No. 29, 8th Lane, Kottawa', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Imesha Suraweera',	       'u20@example.com',	'0764775114',	'No. 32, 9th Lane, Dehiwala', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Anjali Atapattu',	       'u22@example.com',	'0781653223',	'No. 39, 1st Lane, Kottawa', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Sumudu Kumara',	       'u23@example.com',	'0787885953',	'No. 36, 2nd Lane, Kottawa', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1),
('Shan Amarasekara',	       'u24@example.com',	'0764303331',	'No. 57, 4th Lane, Kottawa', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1,	1);


INSERT INTO `notifications` ( `user_id`, `created_at`, `title`, `message`, `type`, `sent`, `seen`) VALUES
(3,'2022-03-28 19:52:18', 'Doctor Consultation Accepted',	'Dr. Weerasinghe accepted your consultation on 2022-03-31 @ 13.30',	'NOTIFICATION',	0,	1),
(3,'2022-03-28 19:52:18', 'Doctor Consultation Accepted',	'Dr. Weerasinghe accepted your consultation on 2022-03-31 @ 13.00p',	'NOTIFICATION',	0,	1),
(3,'2022-03-27 19:12:18', 'Doctor Consultation Cancelled',	'Dr. Weerasinghe cancelled your consultation on 2022-03-26 @ 13.00 ',	'NOTIFICATION',	0,	1),
(3,'2022-03-28 19:32:17', 'Vaccination Reminder',	'Your pet Milo needs to be vaccinated with  \"Anti-Rabies\",  \"DHL\",  \"PARVO\", ',	'NOTIFICATION',	0,	0),
(4,'2022-03-28 19:32:17', 'Vaccination Reminder',	'Your pet Simba needs to be vaccinated with  \"Anti-Rabies\",  \"DHL\",  \"PARVO\", ',	'NOTIFICATION',	0,	0),
(2,'2022-03-28 19:32:17', 'Vaccination Reminder',	'Your pet Luna needs to be vaccinated with  \"Anti-Rabies\",  \"DHL\",  \"PARVO\", ',	'NOTIFICATION',	0,	0);

INSERT INTO `org_user` (`user_id`, `org_id`, `role`) VALUES ('2', '1', 'NORMAL'), ('6', '1', 'ADMIN');

INSERT INTO `org_feedback` (`org_id`, `user_id`, `living_conditions`, `healthcare`, `rescue_response`, `adoptions`, `resource_allocation`, `comments`, `name`, `email`) 
       VALUES ('1', '4', '3', '4', '3', '4', '3', 'Good Work Keep Up', '1', '1'),
       ('1', '3', '2', '4', '2', '3', '4', 'Fast Response to Rescue', '1', '1'),
       ('1', '7', '3', '2', '1', '2', '1', 'Great', '1', '1');

INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`, `user_id`, `photos`,`rescue_report_id`) VALUES 
('14', 'Active and loves cuddles, vaccinated', '2021-08-31', 'LISTED', NULL, '1', NULL, '["/assets/data/dogs/1a.jpg","/assets/data/dogs/1b.jpg","/assets/data/dogs/1c.jpg"]', NULL ),
('21', 'Playful and a joy to be around, vaccinated', '2021-08-26', 'LISTED', NULL, '3', NULL, '["/assets/data/cats/1a.jpg","/assets/data/cats/1b.jpg","/assets/data/cats/1c.jpg"]', NULL),
('12', 'Loves to sleep with his favorite toy, vaccinated', '2021-09-01', 'LISTED', NULL, '2', NULL, '["/assets/data/dogs/2a.jpg","/assets/data/dogs/2b.jpg","/assets/data/dogs/2c.jpg"]', NULL),
('9', 'jade-green eyes, vaccinated','2022-03-01', 'ADOPTED', '2022-03-21', '1','3', '["/assets/data/dogs/3a.jpg","/assets/data/dogs/3b.jpg","/assets/data/dogs/3c.jpg"]', 7),
('22', 'Playful and a joy to be around, vaccinated', '2021-08-26', 'LISTED', NULL, '2',NULL, '["/assets/data/cats/2a.jpg","/assets/data/cats/2b.jpg","/assets/data/cats/2c.jpg"]', NULL),
('10', 'Playful and affectionate, vaccinated', '2021-08-26', 'ADOPTED', '2021-09-15', '1',4, '["/assets/data/dogs/4a.jpg","/assets/data/dogs/4b.jpg"]', 1),
('15', 'Playful and active, vaccinated', '2021-08-26', 'LISTED', NULL, '2',NULL, '["/assets/data/dogs/5a.jpg","/assets/data/dogs/5b.jpg","/assets/data/dogs/5c.jpg"]',NULL),
('4', 'Healthy and a joy to be around, vaccinated', '2021-08-26', 'ADOPTED', '2021-09-14', '1', 3, '["/assets/data/cats/5a.jpg","/assets/data/cats/5b.jpg","/assets/data/cats/5c.jpg"]', NULL),
('16', 'Loves cuddles and needs attention, vaccinated', '2021-08-26', 'LISTED', NULL, '1', NULL, '["/assets/data/dogs/6a.jpg","/assets/data/dogs/6b.jpeg","/assets/data/dogs/6c.jpg"]', NULL),
('23', 'Independent and friendly, vaccinated', '2021-08-26', 'LISTED', NULL, '1',NULL, '["/assets/data/cats/3a.png","/assets/data/cats/3b.jpg","/assets/data/cats/3c.jpg"]', NULL),
('19', 'Has tiny, hedgehog paws, vaccinated', '2022-03-22', 'LISTED', NULL, '1', NULL, '["/assets/data/dogs/15a.jpg","/assets/data/dogs/15b.jpg","/assets/data/dogs/15c.jpg"]', NULL);

INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES 
('9', '3', '1', '2022-03-28', 'ADOPTED', '1', 'The dog that I already have is easy going and bond well with other animals.', '1', 'Used to pets'),
('14', '4', '1', '2022-03-20', 'PENDING', '0', '', '1', 'Had a dog as a pet previously'),
('10', '4', '1', '2021-09-12', 'ADOPTED', '0', '', '1', 'Already Have a pet so Used to pets'), --
('4', '3', '1', '2021-09-02', 'ADOPTED', '0', '', '1', 'Used to pets'), --
('19', '9', '1', '2022-03-27', 'PENDING', '0', '', '1', 'The dog that I already have is easy going and bond well with other animals');

INSERT INTO `routine_updates`(`user_id`, `animal_id`, `type`, `description`, `photo`, `update_date`)
VALUES ('3','4','NUTRITION','Started giving vitamins and is more energetic', '/assets/data/dogs/4a.jpg', '2021-12-03'),
       ('3','4','HEALTH','Playful and active', '/assets/data/dogs/4b.jpg', '2022-02-03');


INSERT INTO `user_pet`(`animal_id`, `user_id`, `status`)
VALUES ('10','4',"ACTIVE"), ('9', '3',"ACTIVE"), ('8', '2',"ACTIVE"), ('7', '3',"ACTIVE"), ('6', '2',"ACTIVE"), ('5', '4',"ACTIVE"), 
       ('4', '3',"ACTIVE"), 
(31,	7,	'ACTIVE'),
(32,	8,	'ACTIVE'),
(33,	9,	'ACTIVE'),
(34,	10,	'ACTIVE'),
(35,	11,	'ACTIVE'),
(36,	12,	'ACTIVE'),
(37,	13,	'ACTIVE'),
(38,	14,	'ACTIVE'),
(39,	15,	'ACTIVE'),
(40,	16,	'ACTIVE'),
(41,	17,	'ACTIVE'),
(42,	18,	'ACTIVE'),
(43,	19,	'ACTIVE'),
(44,	20,	'ACTIVE'),
(45,	21,	'ACTIVE'),
(46,	22,	'ACTIVE'),
(47,	23,	'ACTIVE'),
(48,	24,	'ACTIVE'),
(49,	25,	'ACTIVE'),
(50,	26,	'ACTIVE'),
(51,	27,	'ACTIVE'),
(52,	28,	'ACTIVE');

INSERT INTO `doctor` (`user_id`, `reg_no`, `telephone_fixed`, `credentials`, `proof_image`) 
VALUES (1, '0778985654', '0112136545', 'B.V.Sc.(Sri Lanka)', '["/uploads/1630599314_63.png"]'),
       (5, '0748345654', '0112136545', 'B.V.Sc.(Sri Lanka)', '["/uploads/1630599314_64.png"]');

INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`,  `time_reported`,`accepted_date`, `contact_number`, `location`, `location_coordinates`, `status`, `photos`) 
VALUES ('1', NULL, 'Dog', 'Injured Leg - Emergemcy.',  '2021-08-20 09:15:20','2021-08-20 11:25:20', '0761231234', 'Anuradhapura', POINT(6.8929, 79.9187), 'RESCUED', '["/assets/data/dogs/10.jpg"]'),
('2', NULL, 'Cat', 'Malnutritioned - Need Immediate Care.',   '2022-03-23 19:55:20','2021-08-28 19:55:20', '0761231234', 'Anuradhapura', POINT(6.8999, 79.9167), 'PENDING', '["/assets/data/cats/8.jpg"]'),
('3', NULL, 'Calf', 'Have got hit by a vehicle - Emergency',   '2021-12-29 08:14:20','2021-12-29 10:04:20', '0771234567', 'Anuradhapura', POINT(6.8969, 79.9137), 'IN PROGRESS', '["/assets/data/cats/10.jpg"]'),
('1', NULL, 'Dog', 'Injured Leg',   '2021-12-27 18:55:20','2021-12-27 19:55:20', '0762457654', '12/1, Jayathilake Road, Anuradhapura', POINT(6.8269, 79.9737), 'IN PROGRESS', '["/assets/data/cats/10.jpg"]'),
('1', NULL, 'Cat', 'Severe skin rash',   current_timestamp(),NULL, '0775467215', '77/7, Silva Lane, Colombo 02', POINT(6.1969, 79.7137), 'PENDING', '["/assets/data/cats/10.jpg"]'),
('1', NULL, 'Dog', 'Malnutritioned',   current_timestamp(),NULL, '0722247568', '44/A, Bishop Road, Nugegoda', POINT(6.4969, 79.9137), 'IN PROGRESS', '["/assets/data/cats/10.jpg"]'),
('1', NULL, 'Cat', 'Abandoned near a highway',  '2022-01-22 08:14:20', '2022-01-23 10:04:20', '071275645', 'Piliyandala, close to main road', POINT(6.8969, 79.0137), 'RESCUED', '["/assets/data/cats/10.jpg"]');

INSERT INTO `rescued_animal` (`org_id`, `report_id`, `rescued_date`) 
VALUES ('1', '1', '2021-08-22 16:25:20');
INSERT INTO `rescued_animal` (`org_id`, `report_id`, `rescued_date`) 
VALUES ('2', '2', '2021-08-30 14:35:20');
INSERT INTO `rescued_animal` (`org_id`, `report_id`, `rescued_date`) 
VALUES ('3', '3', '2021-12-29 19:45:20');
INSERT INTO `rescued_animal` (`org_id`, `report_id`, `rescued_date`) 
VALUES ('1', '7', '2022-01-29 13:04:20');


 INSERT INTO `consultation` ( `consultation_date`, `consultation_time`, `animal_id`, `doctor_user_id`, `user_id`, `status`, `type`, `payment_txn_id`,`doctor_rating`, `meeting_id`) 
 VALUES 
('2022-03-25', '11:30:00', 38, 1, 14,	'COMPLETED',	'LIVE',	'cs_test_NjIzMzcxNzg1ODIuMTY4MweEODI0NDc2NTUxMzEuMDMxMzQEMzIxMjE4MD',	4,	'7ewh-ve15-16uf'),
('2022-03-26', '13:00:00', 33, 1, 3 ,	'CANCELLED',	'LIVE',       'cs_test_NDI5Nzk0ODk5NzMuNTQxNDgENjA1MTk3MTQ5NzEuMTc2MDk0ODc3OTI1Nz',	NULL,	'7ewh-ve15-16uf'),
('2022-03-26', '16:00:00', 45, 1, 21,	'ACCEPTED',	'ADVISE',	'cs_test_MjM3NDM5NjY1MjkuMTExMjgyMTk0NzIzMjM5OTUuMTQzODI2NDcwNDE1NT',	NULL,	NULL),
('2022-03-27', '13:00:00', 9 , 1, 3 ,     'EXPIRED',    'LIVE',       'cs_test_MzMyMzI5NDA1NzcuNzExNDkEOTkwODAxMTkzMjEuOTU2NjcENjA2MzkzMj',  NULL,  '7ewh-ve15-16uf'),
('2022-03-27', '12:00:00', 4 , 1, 3 ,     'ACCEPTED',   'ADVISE',     'cs_test_ODg2MTcwMDkxMjMuMzk5OTE0OTE5ODAyODQuNzI4MzIENjg2NDY1ODE4MT',  NULL,  NULL),
('2022-03-27', '16:30:00', 46, 1, 22,	'COMPLETED',	'LIVE',	'cs_test_MzU3MjkyNDI4MTIuNDY1NjUEOTM3NTc0MjY5NjIuNjc0NAEENDYzMTQzND',	3,	'7ewh-ve15-16uf'),
('2022-03-27', '12:30:00', 31, 1, 7 ,	'COMPLETED',	'LIVE',	'cs_test_ODE3NzY2MjMwNDYuMDkzNDgENDM4MTE0NTA1MjAuNTk4MzYEMTI2OTQzNT',	5,	'7ewh-ve15-16uf'),
('2022-03-27', '14:30:00', 42, 1, 18,	'COMPLETED',	'LIVE',	'cs_test_NzkxMjE3MjgwMDEuNzA0OQEEMTYyMzg4NTM0OTIuNjAzMDMzNjk3MTcxOD',	3,	'7ewh-ve15-16uf'),
('2022-03-27', '15:30:00', 44, 1, 20,	'COMPLETED',	'LIVE',	'cs_test_MzQyMTU2OTgyMjcuNTM5MzYEOTQ1MDU1Mzc0ODcuNzY1MzgENzg0MjEzND',	4,	'7ewh-ve15-16uf'),
('2022-03-28', '10:30:00', 10, 1, 3 ,     'ACCEPTED',   'ADVISE',     'cs_test_NTQxNDAyMDY1OTguODg5ODkEMTI1MzA5MzkzODguNDkwNzkxNzI0NjM1MD', NULL,'7ewh-ve15-16uf'),
('2022-03-28', '08:30:00', 40, 1, 16,	'COMPLETED',	'LIVE',	'cs_test_ODg3NjcyMjQzMDIuMTA5MjgEODU5NDQ2MjMwNjguNTIyNzQENzk0ODIzMD',	4,	'7ewh-ve15-16uf'),
('2022-03-28', '14:00:00', 41, 1, 17,	'PENDING',	'LIVE',	'cs_test_Mjk0MjMyNzY5MDIuNTE3MDI1NTIxMjQ2MDc4MTIuNDgyNzgEMTk1NjI4OT',	NULL,	'7ewh-ve15-16uf'),
('2022-03-28', '17:00:00', 47, 1, 23,	'PENDING',	'LIVE',	'cs_test_MzY5MzE0MTgzNDUuMTY3NTEEMTQ2ODIxNDEzNjcuMjU4OTYENDgyNTM5ND',	NULL,	'7ewh-ve15-16uf'),
('2022-03-28', '17:30:00', 48, 1, 24,	'ACCEPTED',	'LIVE',	'cs_test_ODU5MDk0MjU1NjYuNTI3OTcENDI0NDIzNzgxNzEuOTUzNjcENzQzMzE2MT',	NULL,	'7ewh-ve15-16uf'),
('2022-03-28', '18:00:00', 49, 1, 25,	'ACCEPTED',	'LIVE',	'cs_test_OTcyOTIwNjU2ODMuODE3NjMEODIxMTI5ODY4NDcuMTA4NzMENTU0NDc4Mz',	NULL,	'7ewh-ve15-16uf'),
('2022-03-28', '18:30:00', 50, 1, 26,	'PENDING',	'LIVE',	'cs_test_Njk3NDU4MDgwMjYuNDc2NDYEMTE2ODQ1MDg2ODMuNjQ3NDU1NjA5NzEzMz',	NULL,	'7ewh-ve15-16uf'),
('2022-03-28', '19:00:00', 51, 1, 27,	'PENDING',	'LIVE',	'cs_test_ODEwOTg0NTk1NjQuNzc3MDUEODg4MTk2MjQ2NDIuMTYzMjQEODAzMjAyMz',	NULL,	'7ewh-ve15-16uf'),
('2022-03-28', '19:30:00', 52, 1, 28,	'PENDING',	'LIVE',	'cs_test_NTI3NzU1OTM1NjIuODA0NzcEMjExMDU5Mzg5ODcuMzE5MjMENTA2OTE2NT',	NULL,	'7ewh-ve15-16uf'),
('2022-03-29', '10:00:00', 5 , 1, 4 ,     'PENDING',    'ADVISE',     'cs_test_NTQyNjUyOTkzMDcuMzA0MTkENzcxMjkwNzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  NULL),
('2022-03-29', '15:00:00', 43, 1, 19,	'PENDING',	'LIVE',	'cs_test_4DndFQAZTSPAjNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',	NULL,	'7ewh-ve15-16uf'),
('2022-03-29', '12:00:00', 39, 1, 15,	'ACCEPTED',	'LIVE',	'cs_test_4DndFQAZTSPAjNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',	NULL,	'7ewh-ve15-16uf'),
('2022-03-29', '12:30:00', 32, 1, 8 ,	'ACCEPTED',	'LIVE',	'cs_test_zMxME2ODAuODMNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',	NULL,	'7ewh-ve15-16uf'),
('2022-03-29', '13:30:00', 34, 1, 10,	'PENDING',	'LIVE',	'cs_test_zg1OUxMzEuMDMNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',	NULL,	'7ewh-ve15-16uf'),
('2022-03-29', '14:30:00', 36, 1, 12,	'PENDING',	'LIVE',	'cs_test_Dk5NQ5NzEuMTcNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',	NULL,	'7ewh-ve15-16uf'),
('2022-03-30', '09:00:00', 2 , 1, 2 ,     'PENDING',  'ADVISE',       'cs_test_jY1MM5OTUuMTQNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  NULL),
('2022-03-30', '11:00:00', 37, 1, 13,	'PENDING',	'LIVE',	'cs_test_DA1NkzMjEuOTUNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',	NULL,	'7ewh-ve15-16uf'),
('2022-03-30', '11:30:00', 5 , 1, 4 ,     'ACCEPTED',   'LIVE',       'cs_test_DkxMQuNzI4MzINjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  '7ewh-ve15-16uf'),
('2022-03-30', '12:00:00', 6 , 1, 2 ,     'ACCEPTED',  'ADVISE',      'cs_test_DI4MY5NjIuNjcNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  NULL),
('2022-03-30', '12:30:00', 8 , 1, 2 ,     'ACCEPTED',   'ADVISE',     'cs_test_jMwNA1MjAuNTkNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  NULL),
('2022-03-30', '13:30:00', 7 , 1, 3 ,     'ACCEPTED',   'LIVE',       'cs_test_jgwMM0OTIuNjANjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  '7ewh-ve15-16uf'),
('2022-03-30', '14:00:00', 35, 1, 11,	'PENDING',	'LIVE',	'cs_test_TgyMc0ODcuNzYNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',	NULL,	'7ewh-ve15-16uf'),
('2022-03-30', '14:30:00', 6 , 1, 2 ,     'ACCEPTED',   'ADVISE',     'cs_test_DY1OkzODguNDkNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  NULL),
('2022-03-31', '09:30:00', 3 , 1, 2 ,     'PENDING',  'LIVE',         'cs_test_jQzMMwNjguNTINjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  '7ewh-ve15-16uf'),
('2022-03-31', '13:00:00', 4 , 1, 3 ,     'ACCEPTED',   'LIVE',       'cs_test_zY5Mc4MTIuNDgNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  '7ewh-ve15-16uf'),
('2022-03-31', '13:30:00', 7 , 1, 3 ,     'ACCEPTED',  'ADVISE',      'cs_test_TgzNEzNjcuMjUNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj',  NULL,  NULL)
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

INSERT INTO `consultation_message` (`consultation_id`,  `created_at`, `sender`, `message`,seen) 
VALUES ('3', '2022-03-27 08:00:00',  '3', 'My pet have not eaten much in the recent days',true),
       ('3', '2022-03-27 08:10:00',  '1', 'How about the water intake ?',true), 
       ('3', '2022-03-27 08:15:00',  '3', 'It is normal',false), 
       ('3', '2022-03-27 08:16:00',  '3', 'around 1000 ml per day',false),

       ('6', CURRENT_TIMESTAMP,   '1', 'Home treatment advised',false), 
       ('2', '2021-09-13 00:00:00',  '1', 'Advised to take prescribed medicine',false), 

       ('5', '2022-03-28 08:15:00',  '3', 'My pet has swollen paws. What should I do?',true), 
       ('5', '2022-03-28 08:17:00',  '1', 'Swelling can be the result of an insect bite or sting, infection, tissue damage, or other type of injury.',false),
       ('5', '2022-03-28 08:18:00',  '1', 'Do your pet has any signs of pain or discomfort?',false), 
       ('5', '2022-03-28 08:19:00',  '3', 'No', false), 

       ('11',CURRENT_TIMESTAMP, '1','Home treatment advised',false),
       ('13',CURRENT_TIMESTAMP,   '1', 'Prescription given',false);


INSERT INTO `consultation_message` (`consultation_id`, `created_at`, `medical_record_id`, `attachments`, `sender`, `seen`, `message`) VALUES
(5,	'2022-03-28 08:16:00',	NULL,	'[\"/assets/images/dogs/wounded1.jpg\"]',	3,	1,	''),
(11,	'2022-03-28 08:16:00',	NULL,	'[\"/assets/images/dogs/wounded1.jpg\"]',	16,	1,	''),
(11,	'2022-03-28 08:17:00',	NULL,	'[\"/assets/images/dogs/wounded2.jpg\"]',	16,	1,	'');

INSERT INTO `sponsorship` (`org_id`,`name`,`user_id`,`amount_at_subscription`,`start_date`,`end_date`,`status`)
VALUES ('1','Gold','3',5000,'2022-03-01',NULL,'ACTIVE');


INSERT INTO `payment` (`txn_id`, `amount`, `txn_time`, `user`, `status`, `type`) VALUES
('cs_test_a1q3VMzZw4DndD3hXwkmNXiUkJu0dBqW85FQAZTSPAjTM7JGujFNmr8YsM', 2000, '2022-03-24 05:54:55', 3, 'PAID','PAYMENT'),
('cs_test_a1q3VMzZw4DndD3hXwkmNXiUkJu0dBqW85FQAZTSPAjTM7JGujFNmr8Ys3', 4000, '2022-02-14 05:54:55', 9, 'PAID','PAYMENT'),
('cs_test_Nzg5NTQzMzMxMTUuOTIwMDEENzc5ODU4NzE2ODAuODMyMzQEODMwNTE1Mz', 1200, '2021-03-19 21:26:38', 8, 'PAID','PAYMENT'),
-- Consutation Payments

('cs_test_NjIzMzcxNzg1ODIuMTY4MweEODI0NDc2NTUxMzEuMDMxMzQEMzIxMjE4MD', 4000, '2022-03-22 11:30:10', 14, 'PAID','PAYMENT'),
('cs_test_NDI5Nzk0ODk5NzMuNTQxNDgENjA1MTk3MTQ5NzEuMTc2MDk0ODc3OTI1Nz', 2000, '2022-03-23 13:00:15', 3, 'REFUNDED','PAYMENT'),
('cs_test_MjM3NDM5NjY1MjkuMTExMjgyMTk0NzIzMjM5OTUuMTQzODI2NDcwNDE1NT', 2000, '2022-03-23 16:00:15', 21, 'PAID','PAYMENT'),
('cs_test_MzMyMzI5NDA1NzcuNzExNDkEOTkwODAxMTkzMjEuOTU2NjcENjA2MzkzMj', 2000, '2022-03-24 13:00:15', 3, 'PAID','PAYMENT'),
('cs_test_ODg2MTcwMDkxMjMuMzk5OTE0OTE5ODAyODQuNzI4MzIENjg2NDY1ODE4MT', 2000, '2022-03-24 12:00:15', 3, 'PAID','PAYMENT'),
('cs_test_MzU3MjkyNDI4MTIuNDY1NjUEOTM3NTc0MjY5NjIuNjc0NAEENDYzMTQzND', 2000, '2022-03-24 16:30:15', 22, 'PAID','PAYMENT'),
('cs_test_ODE3NzY2MjMwNDYuMDkzNDgENDM4MTE0NTA1MjAuNTk4MzYEMTI2OTQzNT', 2000, '2022-03-24 12:30:15', 7, 'PAID','PAYMENT'),
('cs_test_NzkxMjE3MjgwMDEuNzA0OQEEMTYyMzg4NTM0OTIuNjAzMDMzNjk3MTcxOD', 2000, '2022-03-24 14:30:15', 18, 'PAID','PAYMENT'),
('cs_test_MzQyMTU2OTgyMjcuNTM5MzYEOTQ1MDU1Mzc0ODcuNzY1MzgENzg0MjEzND', 2000, '2022-03-24 15:30:15', 20, 'PAID','PAYMENT'),
('cs_test_NTQxNDAyMDY1OTguODg5ODkEMTI1MzA5MzkzODguNDkwNzkxNzI0NjM1MD', 2000, '2022-03-25 10:30:15', 3, 'PAID','PAYMENT'),
('cs_test_ODg3NjcyMjQzMDIuMTA5MjgEODU5NDQ2MjMwNjguNTIyNzQENzk0ODIzMD', 2000, '2022-03-25 08:30:15', 16, 'PAID','PAYMENT'),
('cs_test_Mjk0MjMyNzY5MDIuNTE3MDI1NTIxMjQ2MDc4MTIuNDgyNzgEMTk1NjI4OT', 2000, '2022-03-25 14:00:15', 17, 'PAID','PAYMENT'),
('cs_test_MzY5MzE0MTgzNDUuMTY3NTEEMTQ2ODIxNDEzNjcuMjU4OTYENDgyNTM5ND', 2000, '2022-03-25 17:00:15', 23, 'PAID','PAYMENT'),
('cs_test_ODU5MDk0MjU1NjYuNTI3OTcENDI0NDIzNzgxNzEuOTUzNjcENzQzMzE2MT', 2000, '2022-03-25 17:30:15', 24, 'PAID','PAYMENT'),
('cs_test_OTcyOTIwNjU2ODMuODE3NjMEODIxMTI5ODY4NDcuMTA4NzMENTU0NDc4Mz', 2000, '2022-03-25 18:00:15', 25, 'PAID','PAYMENT'),
('cs_test_Njk3NDU4MDgwMjYuNDc2NDYEMTE2ODQ1MDg2ODMuNjQ3NDU1NjA5NzEzMz', 2000, '2022-03-25 18:30:15', 26, 'PAID','PAYMENT'),
('cs_test_ODEwOTg0NTk1NjQuNzc3MDUEODg4MTk2MjQ2NDIuMTYzMjQEODAzMjAyMz', 2000, '2022-03-25 19:00:15', 27, 'PAID','PAYMENT'),
('cs_test_NTI3NzU1OTM1NjIuODA0NzcEMjExMDU5Mzg5ODcuMzE5MjMENTA2OTE2NT', 2000, '2022-03-25 19:30:15', 28, 'PAID','PAYMENT'),
('cs_test_NTQyNjUyOTkzMDcuMzA0MTkENzcxMjkwNzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-26 10:00:15', 4, 'PAID','PAYMENT'),
('cs_test_4DndFQAZTSPAjNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-26 15:00:15', 19, 'PAID','PAYMENT'),
('cs_test_3DndFQAZTSPAjNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-26 12:00:15', 15, 'PAID','PAYMENT'),
('cs_test_zMxME2ODAuODMNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-26 12:30:15', 8, 'PAID','PAYMENT'),
('cs_test_zg1OUxMzEuMDMNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-26 13:30:15', 10, 'PAID','PAYMENT'),
('cs_test_Dk5NQ5NzEuMTcNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-26 14:30:15', 12, 'PAID','PAYMENT'),
('cs_test_jY1MM5OTUuMTQNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 09:00:15', 2, 'PAID','PAYMENT'),
('cs_test_DA1NkzMjEuOTUNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 11:00:15', 13, 'PAID','PAYMENT'),
('cs_test_DkxMQuNzI4MzINjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 11:30:15', 4, 'PAID','PAYMENT'),
('cs_test_DI4MY5NjIuNjcNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 12:00:15', 2, 'PAID','PAYMENT'),
('cs_test_jMwNA1MjAuNTkNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 12:30:15', 2, 'PAID','PAYMENT'),
('cs_test_jgwMM0OTIuNjANjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 13:30:15', 3, 'PAID','PAYMENT'),
('cs_test_TgyMc0ODcuNzYNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 14:00:15', 11, 'PAID','PAYMENT'),
('cs_test_DY1OkzODguNDkNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-27 14:30:15', 2, 'PAID','PAYMENT'),
('cs_test_jQzMMwNjguNTINjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-28 08:30:15', 2, 'PAID','PAYMENT'),
('cs_test_zY5Mc4MTIuNDgNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-28 09:00:15', 3, 'PAID','PAYMENT'),
('cs_test_TgzNEzNjcuMjUNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-28 10:00:15', 3, 'PAID','PAYMENT'),
-- consultation Payments End
-- Doctor PayOUT
('cs_test_jU1NgxNzEuOTUNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 26000, '2022-03-27 12:54:55', 1, 'PAID','WITHDRAWAL'),

('cs_test_jU2OY4NDcuMTANjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-24 05:54:55', 2, 'PAID','PAYMENT'),
('cs_test_DgwMg2ODMuNjQNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-24 05:54:55', 2, 'PAID','PAYMENT'),
('cs_test_Tk1NQ2NDIuMTYNjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-24 05:54:55', 2, 'PAID','PAYMENT'),
('cs_test_TM1Ng5ODcuMzENjUyOTkzMDcuMzA0MTkEzU2MDAuMDQxMjYEMjgwMzAyMj', 2000, '2022-03-24 05:54:55', 2, 'PAID','PAYMENT');

INSERT INTO `donation` (`org_id`,`txn_id`,`name`,comments,`subscription_id`) VALUES 
(1,'cs_test_Nzg5NTQzMzMxMTUuOTIwMDEENzc5ODU4NzE2ODAuODMyMzQEODMwNTE1Mz','Hiruni Dahanayake', 'You are doing an amazing job ',NULL),
(1,'cs_test_a1q3VMzZw4DndD3hXwkmNXiUkJu0dBqW85FQAZTSPAjTM7JGujFNmr8Ys3','Dalana','Good Work Keep Going',NULL),
(1,'cs_test_a1q3VMzZw4DndD3hXwkmNXiUkJu0dBqW85FQAZTSPAjTM7JGujFNmr8YsM','Dalana','Use for Animal Foods',1);

INSERT INTO `breeds` (`type`,`breed`,`height`,`weight`,`life_expectancy`,`color`,`photo`,`child_friendly`,`pet_friendly`,`health`,`problems`)
VALUES ('DOG','Beagle',20.0,10.0,10,'["Black"]','["/assets/data/dogs/2.jpg"]','Very Good','Social with other dogs','High risk of eye related issues','Not known for behavioural problems'),
('DOG','Labrador',60.0,20.0,15,'["White","Black","Brown"]','["/assets/data/dogs/3.jpg"]','Very Good','Social, but can become aggressive','High risk of diabetes and cancer','Very high appetite. Need regular exercise'),
('CAT','Domestic Shorthair',20.0,5.0,12,'["White","Black","Brown","Grey","Orange"]','["/assets/data/cats/1.jpg"]','Average','Needs to be exposed to other pets as a kitten','Kidney problems','May become territorial'),
('CAT','Persian',20.0,3.0,12,'["White","Black","Brown","Grey","Orange"]','["/assets/data/cats/6.jpg"]','Average','Not social','Respiratory problems','Need regular grooming');


INSERT INTO medicine(name,doctor_id,age_min,age_max,weight_min,weight_max) 
VAlUES ('Cefovecin',1,null,null,null,null),
       ('Tylosin',1,null,null,null,null),
       ('Amoxicillin',1,null,null,null,null),
       ('Gentamicin',1,null,null,null,null),
       ('Carprofen',1,null,null,null,null),
       ('Selamectin',1,null,null,null,null),
       ('Glycopyrrolate',1,null,null,null,null), 
       ('Hydroxyzine',1,null,null,null,null),
       ('Hydroxyzine',1,null,null,null,null),
       ('Actipet Tablet ',1,null,null,null,null),
       ('Vermectin',1,null,null,null,null);

INSERT INTO `medical_record` ( `animal_id`, `created_at`, `content`) VALUES
( 10,	'2022-03-27 19:53:50',	'Give the tablets after meal'),
( 40,	'2022-03-27 19:53:50',	'Give the tablets after meal');

INSERT INTO `prescription` (`medical_record_id`, `next_visit_date`) VALUES
(1,	NULL),(2,	NULL);

INSERT INTO `prescription_item` (`medical_record_id`, `dose`, `duration`, `direction`, `medicine_id`) VALUES
(1,	'280mg',	'1 Month',	'3 Times',	10),(2,	'150mg',	'1 Week',	'3 Times',	9);

INSERT INTO `consultation_message` (`consultation_id`, `created_at`, `medical_record_id`, `attachments`, `sender`, `seen`, `message`) 
VALUES (10,	'2022-03-27 18:53:50',	NULL,	'[]',	3,	0,	'Can you reccomend a good food suppliment ?'),
       (10,	'2022-03-27 19:53:50',	1,	'[]',	1,	0,	'PRESCRIPTION'),
       (11,	'2022-03-27 19:53:50',	2,	'[]',	1,	0,	'PRESCRIPTION'),
       (10,	'2022-03-27 19:55:50',	NULL,	'[]',	1,	0,	'Please refer the given prescription');
 

INSERT INTO `animal_vaccines`(`animal_id`,`anti_rabies`,`dhl`,`parvo`,`tricat`,`anti_rabies_booster`,`dhl_booster`,`parvo_booster`,`tricat_booster`,`vacc_proof`) 
VALUES('1','2015-10-04','2015-08-02','2015-08-15',NULL,'2021-10-01','2021-08-06','2021-09-16',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('2','2016-04-12','2016-02-27','2016-02-27',NULL,'2021-04-06','2022-02-10','2022-02-10',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('3','2021-01-04','2020-11-14','2020-11-14',NULL,'2022-01-10','2021-11-03',NULL,NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('4','2020-05-10','2020-04-20','2020-04-20',NULL,'2021-05-10','2021-04-15','2021-06-27',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('5','2016-01-03','2015-11-12','2015-11-12',NULL,'2022-01-19','2021-11-17','2021-11-17',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('6','2016-01-03','2015-11-12','2015-11-12',NULL,'2022-01-19','2021-11-17','2021-11-17',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('7',NULL,NULL,NULL,NULL,'2022-01-19','2021-11-17','2021-11-17',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('9',NULL,NULL,NULL,NULL,'2021-12-10','2021-09-15','2021-09-15',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('15','2016-01-03','2015-11-12','2015-11-12',NULL,'2022-01-19','2021-11-17','2021-11-17',NULL,'["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('21','2016-01-03',NULL,'2016-02-06','2016-03-12','2022-01-11',NULL,'2022-02-17','2022-02-17','["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('22','2016-01-03',NULL,'2016-02-06','2016-03-12','2022-01-11',NULL,'2022-02-17','2022-02-17','["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('23','2016-01-03',NULL,'2016-02-06','2016-03-12','2022-01-11',NULL,'2022-02-17','2022-02-17','["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]'),
('25','2016-01-03',NULL,'2016-02-06','2016-03-12','2022-01-11',NULL,'2022-02-17','2022-02-17','["assets/images/vaxproof1.jpg","assets/images/vaxproof2.png","assets/images/vaxproof3.jpg"]');


INSERT INTO `rescue_updates`(`report_id`,`org_id`,`heading`,`description`,`photo`)
VALUES ('1','1','Treatment successful','The injured leg was treated and is now being given antibiotics. Next visit to the clinic is scheduled for 2021-11-25','/assets/images/dogs/wounded1.jpg');

COMMIT;