<?php

class ReportRescue extends BaseModel
{

    static function createReportRescue($org_id,$description,$location,$telephone,$ype,Image $photo)
    {
        $query = "INSERT INTO `report_rescue` ( org_id,description, location, telephone,type,photo) 
                   VALUES (org_id,$description','$location',$telephone,'$type','$photo' )";

$params = [
    "org_id" => $org_id,
    "description" => $description,
    " location" => $location,
    "telephone" => $telephone,
    "type" => $type,
    "photo" => $photo->getURL()
];

return self::insert($query, $params);
    }

    
}

?>