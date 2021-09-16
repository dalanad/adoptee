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
        $query = "SELECT * FROM `animal_for_adoption`, `animal` WHERE animal_for_adoption.org_id = $orgId
        AND animal.animal_id = animal_for_adoption.animal_id";
        return BaseModel::select($query);
    }

    static function getOrgMerchandise($orgId)
    {
        $query = "SELECT * FROM `sponsorship` WHERE sponsorship.org_id = $orgId";
        return BaseModel::select($query);
    }

    static function getOrgSponsorships($orgId)
    {
        $query = "SELECT sponsorship_tier.*, o.org_id, o.name as 'o_name'
        FROM `sponsorship_tier`, `organization` o 
        WHERE sponsorship_tier.org_id = $orgId
        AND o.org_id = $orgId";
        return BaseModel::select($query);
    }

}
