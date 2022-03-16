<?php

class ReportRescue extends BaseModel
{

    static function createReportRescue($description, $location, $telephone, $type, $photos, $lat, $lang)
    {
        $query = "INSERT INTO `report_rescue` (description, location, contact_number, type, photos,location_coordinates) 
                   VALUES (:description, :location, :telephone, :type, :photos , POINT(:lat ,:lang))";

        $params = [
            "description" => $description,
            "location" => $location,
            "telephone" => $telephone,
            "type" => $type,
            "lat" => $lat,
            "lang" => $lang,
            "photos" => $photos
        ];
        self::insert($query, $params);
        return self::lastInsertId();
    }

    static function getRescueReportById($report_id)
    {
        $query = "SELECT *  from `report_rescue` where report_id= :report_id";
        return self::selectOne($query, ["report_id" => $report_id]);
    }

    static function getRescuedPets($user_id)
    {
        $query = "SELECT o.name 'o_name', type, location, photos, ra.*, rr.*
        FROM organization o, report_rescue rr, user, rescued_animal ra
        WHERE o.org_id=rr.org_id 
        AND rr.contact_number=user.telephone
        AND user.user_id=$user_id
        AND rr.report_id=ra.report_id";
        return self::select($query);
    }

    static function getRescueUpdates()
    {
        // $query = "SELECT "
    }
}
