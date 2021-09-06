<?php

class ReportRescue extends BaseModel
{

    static function createReportRescue($description,$location,$telephone,$animal_type,$photo)
    {
        $query = "INSERT INTO `report_rescue` (   `description`, `location`, `telephone`,`animal_type`,`photo`) 
                   VALUES ('$description',$location,$telephone,$animal_type,'$photo' )";

        return BaseModel::insert($query);
    }

}

?>