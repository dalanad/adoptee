use adoptee;

INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`, `about`) 
VALUES ('Pet Haven', '0112345678', 'No. 58', '5th Lane', 'Battaramulla', 'Help an animal in need', 'LOGO', 'Animal Haven is a 
nonprofit organization that finds homes for abandoned cats and dogs and improves chances of adoption.');
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`) 
VALUES ('Animal Shelter', '0334567891', 'No.14/A', 'Temple Road', 'Colombo 8', 'Save a Pet', 'LOGO');
INSERT INTO `organization` (`name`, `telephone`, `address_line_1`, `address_line_2`, `city`, `tagline`, `logo`) 
VALUES ('Animal Welfare Centre', '0114567891', 'No. 120', 'Circular Road', 'Dehiwala', 'Give a pet a home', 'LOGO');

 
INSERT INTO `org_content` (`org_id`, `heading`, `description`, `photo`)
VALUES ('1', 'Clinic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO'),
  ('1', 'Vaccination Program', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO'),
  ('2', 'Volunteer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO'),
  ('3', 'Adoption Day', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus justo eget libero sodales, ac hendrerit est scelerisque. Ut cursus ante bibendum ante  molestie, a varius nisl sodales.', 'PHOTO');
 

INSERT INTO `animal` (`animal_id`, `type`, `name`, `gender`, `dob`, `color`) 
VALUES (NULL, 'Dog', 'Tigger', 'Male', '2021-07-01', 'Black');
INSERT INTO `animal` (`animal_id`, `type`, `name`, `gender`, `dob`, `color`) 
VALUES (NULL, 'Cat', 'Leo', 'Male', '2016-01-15', 'Orange');
INSERT INTO `animal` (`animal_id`, `type`, `name`, `gender`, `dob`, `color`) 
VALUES (NULL, 'Dog', 'Oliver', 'Female', '2021-12-16', 'White');
INSERT INTO `animal` (`animal_id`, `type`, `name`, `gender`, `dob`, `color`) 
VALUES (NULL, 'Cat', 'Milo', 'Female', '2020-02-10', 'Golden Brown');
INSERT INTO `animal` (`animal_id`, `type`, `name`, `gender`, `dob`, `color`) 
VALUES (NULL, 'Dog', 'Simba', 'Male', '2015-10-01', 'Grey');

INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`) 
VALUES ('1', 'Active and loves cuddles', '2021-08-31', 'ADOPTED', '2021-09-03', '1');
INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`) 
VALUES ('2', 'Loves to sleep with his favorite toy', '2021-09-01', 'LISTED', NULL, '2');
INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`) 
VALUES ('3', 'jade-green eyes', '2021-09-01', 'LISTED', NULL, '1');
INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`) 
VALUES ('4', 'Playful and a joy to be around', '2021-08-26', 'ADOPTED', '2021-09-01', '1');
INSERT INTO `animal_for_adoption` (`animal_id`, `description`, `date_listed`, `status`, `date_adopted`, `org_id`) 
VALUES ('5', 'Has tiny, hedgehog paws', '2021-09-02', 'LISTED', NULL, '1');


INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`, `email_verified`, `telephone_verified`) VALUES
('Dr. Weerasinghe', 'doctor@example.com', '0761236547', 'doctor address', '$$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW',1, 1),
('Ms. Org User', 'orguser@example.com', '0761236547', 'user address', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1),
('Mr. Reg. User', 'user@example.com', '0761236547', 'user address', '$2y$10$VnsCjO9nOHxbaSrOubIJFuadqw.hkaGgcg4DoKGAAYyooimqMhbGW', 1, 1);

INSERT INTO `org_user` (`user_id`, `org_id`, `role`) VALUES ('2', '1', 'NORMAL');

INSERT INTO `doctor` (`user_id`, `reg_no`, `telephone_fixed`, `credentials`, `proof_image`) 
VALUES (1, '0778985654', '0112136545', 'B.V.Sc.(Sri Lanka)', '/uploads/1630599314_63.png') ;

INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`, `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photo`) 
VALUES ('1', NULL, 'Dog', 'Injured Leg - Emergemcy. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt  ', current_timestamp(), '0771234567', 'Anuradhapura', NULL, 'PENDING', '');
INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`, `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photo`) 
VALUES ('2', NULL, 'Cat', 'Malnutritioned - Need Immediate Care. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor  ', current_timestamp(), '0771234567', 'Anuradhapura', NULL, 'PENDING', '');
INSERT INTO `report_rescue` (`org_id`, `report_id`, `type`, `description`, `time_reported`, `contact_number`, `location`, `location_coordinates`, `status`, `photo`) 
VALUES ('3', NULL, 'Calf', 'Have got hit by a vehicle - Emergency.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', current_timestamp(), '0771234567', 'Anuradhapura', NULL, 'PENDING', '');

 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `approval_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('1', '3', '1', '2021-08-01', NULL, 'PENDING', '1', 'The dog that I already have is easy going and bond well with other animals.', '1', 'Used to pets');
 INSERT INTO `adoption_request` (`animal_id`, `user_id`, `org_id`, `request_date`, `approval_date`, `status`, `has_pets`, `petsafety`, `children`, `childsafety`) 
 VALUES ('2', '3', '1', '2021-10-02', NULL, 'PENDING', '0', '', '1', 'Used to pets');