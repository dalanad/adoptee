<?php

class ReportRescue extends BaseModel
{
    static function createReportRescue($description,$loaction,$photo)
    {
        $query = "INSERT INTO `report_rescue` (   `description`, `loaction`, `photo`) 
VALUES ('$description',$location,'$photo' )";
        return BaseModel::insert($query);
    }
}

?>