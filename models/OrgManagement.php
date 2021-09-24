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

    
    static function editAnimalData($status, $name, $type, $gender, $dob, $color, $description, $photo)
    {
        
        $query = "INSERT INTO `animal_for_adoption` (photo)
        VALUES ('$photo')";
        echo($query);
        BaseModel::insert($query);

        $query = "UPDATE `animal_for_adoption` SET status = '$status' WHERE isset($status);
        UPDATE `animal_for_adoption` SET name = '$name' WHERE isset($name);
        UPDATE `animal_for_adoption` SET type = $type WHERE isset($type);
        UPDATE `animal_for_adoption` SET gender = '$gender' WHERE isset($gender);
        UPDATE `animal_for_adoption` SET dob = '$dob' WHERE isset($dob);
        UPDATE `animal_for_adoption` SET color = '$color' WHERE isset($color);
        UPDATE `animal_for_adoption` SET description = '$description' WHERE isset($description)";

        return BaseModel::insert($query);
    }

    static function accept_adoption_request($animal_id)
    {
        $query = "UPDATE `animal_for_adoption` SET status = 'ADOPTED' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function reject_adoption_request($animal_id)
    {
        $query = "UPDATE `animal_for_adoption` SET status = 'PENDING' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
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

    static function findRescuedAnimalsByOrgId(){
        $query = "SELECT * from report_rescue";
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
