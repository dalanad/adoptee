<?php

class Organization extends BaseModel
{
    public static function createOrganization($name, $telephone, $address_line_1, $address_line_2, $city)
    {
        $query = "INSERT INTO `organization` (  `name`, `telephone`, `address_line_1`, `address_line_2`, `city`) 
                VALUES ( '$name', $telephone, '$address_line_1', '$address_line_2', '$city')";
        return BaseModel::insert($query);
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

    public function getOrgAnimalsForAdoption()
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

}
