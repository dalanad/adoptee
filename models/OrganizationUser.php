<?php
class OrganizationUser extends BaseModel
{
    public static function findUserByUID($user_id)
    {
        $query = "SELECT *  FROM `org_user` WHERE user_id= :user_id AND status = 'ACTIVE' ";
        return self::select($query, ["user_id" => $user_id]);
    }

    public static function createOrgUser($org_id, $name, $email, $telephone, $address, $password)
    {
        $user_id = User::createUser($name, $email, $telephone, $address, $password);
        $query = "INSERT INTO org_user (user_id, org_id, role) VALUES (:user_id, :org_id, 'NORMAL');";
        self::insert($query, ["user_id" => $user_id, "org_id" => $org_id]);
    }

    public static function updateUser($user_id, $name, $email, $telephone)
    {
        $query = "UPDATE `user` SET `name` = :name, `email` = :email, `telephone` = :telephone WHERE `user`.`user_id` = :user_id";
        self::insert($query, [
            "user_id" => $user_id,
            "name" => $name,
            "email" => $email,
            "telephone" => $telephone,
        ]);
    }

    public static function disableUser($user_id)
    {
        $query = "UPDATE `org_user` SET `status` = 'DISABLED' WHERE `org_user`.`user_id` = :user_id";
        self::insert($query, ["user_id" => $user_id]);
    }

    public static function activateUser($user_id)
    {
        $query = "UPDATE `org_user` SET `status` = 'ACTIVE' WHERE `org_user`.`user_id` = :user_id";
        self::insert($query, ["user_id" => $user_id]);
    }

    public static  function changeRole($user_id, $new_role)
    {
        $query = "UPDATE `org_user` SET `role` = :new_role WHERE `org_user`.`user_id` = :user_id";
        self::insert($query, ["user_id" => $user_id, "new_role" => $new_role]);
    }
}
