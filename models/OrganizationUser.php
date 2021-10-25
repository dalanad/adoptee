<?php
class OrganizationUser extends BaseModel
{
    public static function findUserByUID($user_id)
    {
        $query = "select *  from `org_user` where user_id= '$user_id'";
        return self::select($query);
    }

    public static function createOrgUser($org_id, $name, $email, $telephone, $address, $password)
    {
        $user_id = User::createUser($name, $email, $telephone, $address, $password);
        $query = "INSERT INTO org_user (user_id, org_id, role) VALUES ('$user_id', '$org_id', 'NORMAL');";
        self::insert($query);
    }
}
