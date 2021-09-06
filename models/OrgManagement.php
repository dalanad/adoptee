<?php

class OrgManagement extends BaseModel
{
    static function createNewAnimal($org_id, $type, $other, $gender, $dob, $color, $description, $photo)
    {
        $query = " INSERT INTO `animal` (type, other, gender, dob, color) VALUES ('$type', '$other', '$gender', '$dob', '$color')";
        echo($query);
        BaseModel::insert($query);
        $animal_ID = BaseModel::lastInsertId();

        $query = "INSERT INTO `animal_for_adoption` (animal_id, org_id, description)
                  VALUES ('$animal_ID', '$org_id', '$description')";
        return BaseModel::insert($query);
    }

    static function findAnimalsByOrgId($org_id)
    {
        $query = "SELECT animal.animal_id, name,type,dob,gender,date_listed,status,date_adopted,description from animal_for_adoption,animal where org_id= $org_id and animal.animal_id=animal_for_adoption.animal_id";
        return BaseModel::select($query);
    }

    static function findRequestsByOrgId($org_id)
    {
        $query = "SELECT animal.name, animal.type, adoption_request.user_id,user.name,request_date,status,has_pets,petsafety,children,childsafety from adoption_request,user,animal where org_id= $org_id and adoption_request.user_id=user.user_id";
        return BaseModel::select($query);
    }

    
    static function findReportedCases(){
        $query = "SELECT type, description, contact_number,location, status, photo, time_reported,org_response from report_rescue";
        return BaseModel::select($query);
    }

    static function updateRescueReportStatus($report_id)
    {
        $query = "UPDATE `report_rescue` SET status='ACCEPTED' WHERE report_id=$report_id;
        UPDATE `report_rescue` SET org_response='ACCEPTED' WHERE report_id=$report_id;
        UPDATE `report_rescue` SET org_id = $_SESSION('org_id') WHERE report_id=$report_id";
        return BaseModel::update($query);
    }

    public static function searchAnimals()
    {
        $query = "
        SELECT
            a.*,
            afa.*,
            DATEDIFF(CURRENT_DATE, a.dob) / 365 'age',
            o.name 'org_name'
        FROM
            animal_for_adoption afa
        INNER JOIN animal a ON
            a.animal_id = afa.animal_id
        INNER JOIN organization o ON
            o.org_id = afa.org_id    
        ";
        return self::select($query);
    }
}
