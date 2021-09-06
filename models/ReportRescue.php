<?php

class ReportRescue extends BaseModel
{

    static function createReportRescue($description, $location, $telephone, $type, Image $photo)
    {
        $query = "INSERT INTO `report_rescue` (description, location, contact_number, type, photo) 
                   VALUES (:description, :location, :telephone, :type, :photo )";

        $params = [
            "description" => $description,
            "location" => $location,
            "telephone" => $telephone,
            "type" => $type,
            "photo" => $photo->getURL()
        ];

        return self::insert($query, $params);
    }
}
