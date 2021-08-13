<?php

class Organization extends BaseModel
{
    static function createOrganization($data)
    {
        $query = "INSERT INTO `organization` (  `name`, `telephone`, `address_line_1`, `address_line_2`, `city`) 
VALUES ( '" . $data["name"] . "', '" . $data["telephone"] . "', '" . $data["address_line_1"] . "', '" . $data["address_line_2"] . "', '" . $data["city"] . "')";
        return BaseModel::insert($query);
    }
}
