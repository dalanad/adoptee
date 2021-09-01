<?php
class OrganizationUser extends BaseModel
{
    public static function findUserByUID($user_id)
    {
        $query = "select *  from `org_user` where user_id= '$user_id'";
        return self::select($query);
    }
}
