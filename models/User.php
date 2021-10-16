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

    static function updateProfileData($name, $email, $telephone, $address)
    {
        $query = "UPDATE `user` SET name = '$name' WHERE isset($name);
        UPDATE `user` SET email = '$email' WHERE isset($email);
        UPDATE `user` SET telephone = $telephone WHERE isset($telephone);
        UPDATE `user` SET address = '$address' WHERE isset($address)";
        return self::insert($query);
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
        return self::update($query);
    }

    static function getAdoptions($user_id)
    {
        $query = "SELECT animal.name 'a_name', animal.animal_id 'a_id',animal.photo 'photo', DATEDIFF(CURRENT_DATE, animal.dob)/365 'age', organization.name 'name', date_adopted
        FROM `animal`, `animal_for_adoption`, `organization`, `user`
        WHERE animal.animal_id=animal_for_adoption.animal_id
        AND organization.org_id=animal_for_adoption.org_id
        AND user.user_id=animal_for_adoption.user_id
        AND user.user_id=$user_id";
        return self::select($query);
    }

    static function getUserPets($user_id)
    {
        $query = "SELECT animal.*, round(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age'
        FROM user_pet, animal
        WHERE ($user_id = user_pet.user_id AND user_pet.animal_id=animal.animal_id)
        UNION SELECT animal.*, round(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age'
        FROM animal, animal_for_adoption afa
        WHERE ($user_id = afa.user_id AND afa.animal_id = animal.animal_id)";
        return self::select($query);
    }

    static function getUpcomingConsultations($user_id)
    {
        $query = "SELECT c.consultation_date 'date', c.consultation_time 'time', c.status, c.type, a.name 'pet', u.name 'doctor'
        FROM consultation c, animal a, user u
        WHERE c.user_id = $user_id
        AND c.doctor_user_id = u.user_id
        AND a.animal_id = c.animal_id
        AND (status='PENDING' OR status='ACCEPTED')";
        return self::select($query);
    }
}
