<?php

class User extends BaseModel
{
    static function matchPasswords($pass1, $pass2)
    {
        if ($pass1 == $pass2) {
            return true;
        } else {
            return false;
        }
    }

    static function createUser($name, $email, $telephone, $address, $password)
    {
        $hashed_password = Crypto::hash($password);
        $query = "INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`) VALUES ('$name', '$email', '$telephone', '$address', '$hashed_password')";
        self::insert($query);
        return self::lastInsertId();
    }

    static function updateProfileData($name, $email, $telephone, $address, $user_id)
    {
        $query = "SELECT * from `user` WHERE user_id = $user_id";
        $user = self::select($query);

        if ($name != $user[0]['name']) {
            $query = "UPDATE `user` SET name = '$name' WHERE user_id = $user_id";
            self::update($query);
            $_SESSION['user']['name'] = $name;
        }

        if ($address != $user[0]['address']) {
            $query = "UPDATE `user` SET address = '$address' WHERE user_id = $user_id";
            self::update($query);
            $_SESSION['user']['address'] = $address;
        }

        if ($email != $user[0]['email']) {
            $query = "UPDATE `user` SET email = '$email', email_verified = 0  WHERE user_id = $user_id";
            self::update($query);
        }
        $telephone = strval($telephone);
        if ($telephone != $user[0]['telephone']) {
            $query = "UPDATE `user` SET telephone = '$telephone', telephone_verified = 0 WHERE user_id = $user_id";
            self::update($query);
        }
    }

    static function findUserByEmail($email)
    {
        $query = "select *  from `user` where email = :email";
        return self::selectOne($query, ['email' => $email]);
    }

    static function findUserById($user_id)
    {
        $query = "select *  from `user` where user_id= :user_id";
        return self::selectOne($query, ["user_id" => $user_id]);
    }

    static function verifyEmail($email)
    {
        $query = "update `user` set email_verified = 1 where email= '$email'";
        return self::update($query);
    }

    static function verifySMS($email)
    {
        $query = "update `user` set telephone_verified = 1 where email= '$email'";
        return self::update($query);
    }

    static function changePassword($email, $new)
    {
        $hashed_password = Crypto::hash($new);
        $query = "UPDATE user set password= '$hashed_password' WHERE email = '$email'";
        self::update($query);
    }

    static function getAdoptions($user_id)
    {
        $query = "SELECT animal.name 'a_name', animal.animal_id 'a_id',animal.photo 'photo', DATEDIFF(CURRENT_DATE, animal.dob)/365 'age', organization.name 'o_name', date_adopted, user_pet.status
        FROM `animal`, `animal_for_adoption`, `organization`, `user`, user_pet
        WHERE animal.animal_id=animal_for_adoption.animal_id
        AND organization.org_id=animal_for_adoption.org_id
        AND user.user_id=animal_for_adoption.user_id
        AND animal_for_adoption.user_id=$user_id
        AND user_pet.user_id=$user_id
        AND user_pet.animal_id=animal_for_adoption.animal_id";
        return self::select($query);
    }

    static function getUserPets($user_id)
    {
        $query = "SELECT DISTINCT animal.*, round(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age', user_pet.status
        FROM user_pet, animal, animal_for_adoption afa
        WHERE ($user_id = user_pet.user_id AND user_pet.animal_id=animal.animal_id AND $user_id=afa.user_id)";
        return self::select($query);
    }

    static function deletePet($petid)
    {
        $query = "UPDATE `user_pet` SET `status`='REMOVED' WHERE animal_id = $petid;";
        self::update($query);
    }

    static function getUpcomingConsultations($user_id)
    {
        $query = "SELECT c.consultation_id, c.consultation_date 'date', c.consultation_time 'time', c.status, c.type, a.name 'pet', u.name 'doctor'
        FROM consultation c, animal a, user u
        WHERE c.user_id = $user_id
        AND c.doctor_user_id = u.user_id
        AND a.animal_id = c.animal_id
        AND (status='PENDING' OR status='ACCEPTED')
        ORDER BY created_date DESC";
        return self::select($query);
    }

    static function getNotifications($user_id, $limit_to = 3)
    {
        $query = "SELECT * FROM `notifications` WHERE user_id = :user_id ORDER BY created_at desc LIMIT  $limit_to";
        return self::select($query, ["user_id" => $user_id]);
    }

    static function getSubscriptions()
    {
        $user_id = $_SESSION['user']['user_id'];
        $query = "SELECT s.*, st.*, o.name as org
        FROM `sponsorship` s,`sponsorship_tier` st,  `organization` o
        WHERE s.user_id = $user_id
        AND s.org_id = st.org_id
        AND s.name = st.name
        AND o.org_id = s.org_id";

        return self::select($query);
    }

    public static function getPaymentsHistory($user_id)
    {
        $query = "SELECT
            p.txn_time as ttime, 
            p.*,
            CONCAT(u.name, ' - Consultation <br><small>', c.type, ' - #', c.consultation_id,' - ', c.consultation_date , '</small>') reason
        FROM payment p  
            JOIN consultation c ON p.txn_id = c.payment_txn_id
            JOIN user u ON c.doctor_user_id = u.user_id WHERE p.user = :user
        
        UNION
        SELECT 
            p.txn_time as ttime, 
            p.*,
            CONCAT('Donation to ',o.name) reason
        FROM payment p  
            JOIN donation d ON d.txn_id = p.txn_id
            JOIN organization o ON d.org_id = o.org_id
            WHERE p.user = :user

        ORDER BY ttime desc ";

        return self::select($query, ["user" => $user_id]);
    }
}
