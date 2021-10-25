<?php

class Organization extends BaseModel
{
    public static function registerOrganization($name, $email, $telephone, $address_line_1, $address_line_2, $city, $password)
    {
        User::createUser($name,  $email, $telephone, $address_line_1 . " " . $address_line_2,  $password);
        $user_id = self::lastInsertId();

        $query = "INSERT INTO organization (name, telephone, address_line_1, address_line_2, city) 
                  VALUES ('$name', $telephone, '$address_line_1', '$address_line_2', '$city')";
        self::insert($query);
        $org_id = self::lastInsertId();

        $query = "INSERT INTO org_user (user_id, org_id, role) VALUES ('$user_id', '$org_id', 'ADMIN');";
        self::insert($query);
    }

    public static function getOrgUsers($orgId)
    {
        $query = "SELECT u.*, ou.role FROM user u, org_user ou WHERE u.user_id=ou.user_id AND ou.org_id = $orgId";
        return self::select($query);
    }

    public function getOrgListing()
    {
        $query = "SELECT * FROM `organization`";
        return BaseModel::select($query);
    }

    public function getOrgDetails($orgId)
    {
        $query = "SELECT * FROM `organization` WHERE org_id = $orgId";
        return BaseModel::select($query);
    }

    public function getOrgAnimalsForAdoption()   //function not used
    {
        $query = "SELECT animal_id, type, gender FROM `animal_for_adoption`, `organization`
        WHERE `animal_for_adoption`.org_id = `organization`.org_id";
        return BaseModel::select($query);
    }

    static function findOrgById($orgId)
    {
        $query = "SELECT * FROM `organization` WHERE org_id = $orgId";
        return BaseModel::select($query);
    }

    static function getOrgContent($orgId)
    {
        $query = "SELECT * FROM `org_content` WHERE org_id = $orgId";
        return BaseModel::select($query);
    }

    static function getOrgAdoptions($orgId)
    {
        $query = "SELECT *, DATEDIFF(CURRENT_DATE, animal.dob)/365 'age'
        FROM `animal_for_adoption`, `animal` WHERE animal_for_adoption.org_id = $orgId
        AND animal.animal_id = animal_for_adoption.animal_id";
        return BaseModel::select($query);
    }

    static function getOrgMerchandise($orgId)
    {
        $query = "SELECT * FROM `org_merch_item` WHERE org_merch_item.org_id = $orgId";
        return BaseModel::select($query);
    }

    static function getOrgSponsorships($orgId)
    {
        $query = "SELECT sponsorship_tier.*, o.org_id
        FROM `sponsorship_tier`, `organization` o 
        WHERE sponsorship_tier.org_id = $orgId
        AND o.org_id = $orgId";
        return BaseModel::select($query);
    }
}
