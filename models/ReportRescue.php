<?php

class ReportRescue extends BaseModel
{
    static function createReportRescue($description,$location,$photo)
    {
        $query = "INSERT INTO `report_rescue` (   `description`, `location`, `photo`) 
VALUES ('$description',$location,'$photo' )";
        return BaseModel::insert($query);
    }

    static function findReportedCases(){
        $query = "select * from report_rescue";
        return BaseModel::select($query);
    }
}

?>