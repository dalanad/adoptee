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

    static function getRescuedPets($user_id)
    {
        $query = "SELECT o.name 'o_name', type, location, photo, ra.*, rr.*
        FROM organization o, report_rescue rr, user, rescued_animal ra
        WHERE o.org_id=rr.org_id 
        AND rr.contact_number=user.telephone
        AND user.user_id=$user_id
        AND rr.report_id=ra.report_id";
        return BaseModel::select($query);
    }
}
