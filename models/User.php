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
        BaseModel::insert($query);
        return self::lastInsertId();
    }

    static function updateProfileData($name, $email, $telephone, $address)
    {
        $query = "UPDATE `user` SET name = '$name' WHERE isset($name);
        UPDATE `user` SET email = '$email' WHERE isset($email);
        UPDATE `user` SET telephone = $telephone WHERE isset($telephone);
        UPDATE `user` SET address = '$address' WHERE isset($address)";
        return BaseModel::insert($query);
    }

    static function findUserByEmail($email)
    {
        $query = "select *  from `user` where email= '$email'";
        return BaseModel::select($query)[0];
    }

    static function findUserById($user_id)
    {
        $query = "select *  from `user` where user_id= :user_id";
        return BaseModel::select($query, ["user_id" => $user_id])[0];
    }

    static function verifyEmail($email)
    {
        $query = "update `user` set email_verified = 1 where email= '$email'";
        return BaseModel::update($query);
    }

    static function verifySMS($email)
    {
        $query = "update `user` set telephone_verified = 1 where email= '$email'";
        return BaseModel::update($query);
    }

    static function changePassword($email, $new)
    {
        $hashed_password = Crypto::hash($new);
        $query = "UPDATE user set password= '$hashed_password' WHERE email = '$email'";
        return BaseModel::update($query);
    }

    static function getAdoptions($user_id)
    {
        $query = "SELECT animal.name 'a_name', animal.animal_id 'a_id', DATEDIFF(CURRENT_DATE, animal.dob)/365 'age', organization.name 'name', date_adopted
        FROM `animal`, `animal_for_adoption`, `organization`, `user`
        WHERE animal.animal_id=animal_for_adoption.animal_id
        AND organization.org_id=animal_for_adoption.org_id
        AND user.user_id=animal_for_adoption.user_id
        AND user.user_id=$user_id";
        return BaseModel::select($query);
    }

    static function getUserPets($user_id)
    {
        $query = "SELECT user_pet.*, animal.*, user.user_id, round(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age'
        FROM user_pet, animal, user
        WHERE $user_id=user.user_id
        AND user_pet.user_id=user.user_id
        AND user_pet.animal_id=animal.animal_id";
        return BaseModel::select($query);
    }
}
