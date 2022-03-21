<?php

class OrgManagement extends BaseModel
{
    static function createNewAnimal($org_id, $name, $type, $gender, $dob, $color, $description, $anti_rabies, $dhl, $parvo, $tricat, $anti_rabies_booster, $dhl_booster, $parvo_booster, $tricat_booster, $dewormed, $vacc_proof, $avatar_photo, $adoptee_photo)
    {
        $org_id = $_SESSION['org_id'];

        /*        if ($type == 'other') {
            $type = $other;
        } */
        /* $type = ($type == 'other')? $other: $type; */
        $color = json_encode($color);

        $query = " INSERT INTO `animal` (name, type, gender, color, dob, photo) VALUES ('$name', '$type', '$gender', '$color', '$dob', '$avatar_photo')";
        echo ($query);
        BaseModel::insert($query);
        $animal_ID = BaseModel::lastInsertId();

        $query = "INSERT INTO `animal_vaccines` (animal_id, anti_rabies, dhl, parvo, tricat, anti_rabies_booster, dhl_booster, parvo_booster, tricat_booster, vacc_proof)
                  VALUES ('$animal_ID', '$anti_rabies', '$dhl', '$parvo', '$tricat', '$anti_rabies_booster', '$dhl_booster', '$parvo_booster', '$tricat_booster', '$vacc_proof')";
        echo ($query);
        BaseModel::insert($query);

        $report_id = $_POST['report_id'];
        $query = "INSERT INTO `animal_for_adoption` (animal_id, org_id, description, date_listed, dewormed, photos, rescue_report_id)
                  VALUES ('$animal_ID', '$org_id', '$description', curdate(), '$dewormed', '$adoptee_photo', '$report_id')";
        return BaseModel::insert($query);
    }

    static function findAnimalsByOrgId()
    {
        $org_id = $_SESSION['org_id'];
        $query = "SELECT animal.animal_id, name,type, other, color, dob, 
        FLOOR(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age', gender,
        date_listed,status,date_adopted,description, 
        animal.photo as avatar_photo,
        animal_for_adoption.photos as adoptee_photo
        from animal_for_adoption,animal 
            where org_id= $org_id 
            and animal.animal_id=animal_for_adoption.animal_id and animal_for_adoption.status<>'DELETED'";
        return BaseModel::select($query);
    }


    static function editAnimalData($status, $name, $type, $gender, $dob, $description, $photos)
    {

        /*         $query = "INSERT INTO `animal_for_adoption` (photo)
        VALUES ('$photo')";
        echo($query);
        BaseModel::insert($query); */

        $query = "UPDATE `animal_for_adoption` SET status = '$status' WHERE isset($status);
        UPDATE `animal` SET name = '$name' WHERE isset($name);
        UPDATE `animal` SET type = $type WHERE isset($type);
        UPDATE `animal` SET gender = '$gender' WHERE isset($gender);
        UPDATE `animal` SET dob = '$dob' WHERE isset($dob);
        UPDATE `animal_for_adoption` SET description = '$description' WHERE isset($description)";

        return BaseModel::insert($query);
    }

    static function delete_animal($animal_id)
    {
        $query = "UPDATE `animal_for_adoption` SET status = 'DELETED' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function findRequestsByOrgId()
    {
        $query = "SELECT 
        animal.name as animal_name, 
        animal.type,
        animal.gender as gender, 
        user.user_id,
        user.name as user_name,
        user.address as address,
        user.email as email,
        user.telephone as contact,
        request_date,
        status,
        has_pets,
        petsafety,
        children,
        childsafety,
        animal.animal_id,
        animal.photo,
        request_date
        from adoption_request
        INNER JOIN animal ON
            animal.animal_id = adoption_request.animal_id
        INNER JOIN user ON
            user.user_id = adoption_request.user_id
        WHERE org_id = '$_SESSION[org_id]'";
        return BaseModel::select($query);
    }

    static function accept_adoption_request($animal_id, $user_id)
    {

        $query = "UPDATE `adoption_request` SET status = 'ACCEPTED' WHERE animal_id='$animal_id' AND user_id = '$user_id';
        INSERT INTO `user_pet`(`animal_id`, `user_id`) VALUES('$animal_id','$user_id');
        UPDATE `animal_for_adoption` SET status = 'ADOPTED', date_adopted = curdate(), user_id = '$user_id' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function reject_adoption_request($animal_id)
    {
        $query = "UPDATE `adoption_request` SET status = 'REJECTED' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function mark_as_complete($report_id)
    {
    
        $query = "UPDATE `report_rescue` SET status = 'RESCUED' WHERE report_id='$report_id';
        INSERT INTO `rescued_animal`(`org_id`, `report_id`, `rescued_date`) VALUES('$_SESSION[org_id]','$report_id', curdate());";

        return BaseModel::insert($query);
    }

    static function findReportedCases()
    {
        $query = "SELECT type, description, contact_number,location, st_y(location_coordinates) as longi, st_x(location_coordinates) as lat, status, photos, time_reported from report_rescue";
        return BaseModel::select($query);
    }

    static function rescue_animal($report_id, $type)
    {
        $org_id = $_SESSION['org_id'];

        $query = " INSERT INTO `animal` (type) VALUES ('$type')";
        echo ($query);
        BaseModel::insert($query);
        $animal_ID = BaseModel::lastInsertId();

        $query = "UPDATE `report_rescue` SET org_id = '$org_id' status = 'IN PROGRESS' accepted_date=curdate() WHERE report_id='$report_id'";
        echo ($query);
        return BaseModel::insert($query);
    }

    static function findRescuedAnimalsByOrgId()
    {
        $org_id = $_SESSION['org_id'];

        $query = "SELECT * from report_rescue, rescued_animal WHERE report_rescue.report_id = rescued_animal.report_id AND rescued_animal.org_id = '$org_id'";
        return BaseModel::select($query);
    }

    static function add_rescue_update($report_id, $description, $photos)
    {
        $report_id = $_SESSION[$report_id];

        $query = "UPDATE `report_rescue` SET description = '$description' WHERE report_id='$report_id';
        UPDATE `report_rescue` SET photos = '$photos' WHERE report_id='$report_id'";
        return BaseModel::insert($query);
    }

    static function findOrgContentByOrgId()
    {
        $org_id = $_SESSION['org_id'];

        $query = "SELECT * from org_content WHERE org_id = '$org_id'";
        return BaseModel::select($query);
    }

    static function add_new_event($org_id, $heading, $description, $photos)
    {
        $query = "INSERT INTO `org_content` (org_id, created_time, heading, description, photos)
        VALUES ('$org_id', CURRENT_TIMESTAMP, '$heading', '$description', '$photos')";

        return BaseModel::insert($query);
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

    static function animals_report()
    {
        $org_id = $_SESSION['org_id'];

        $query = "SELECT * from animal_for_adoption WHERE org_id = '$org_id' ";
        return BaseModel::select($query);
    }

    static function adoptions_updates_report()
    {
        $org_id = $_SESSION['org_id'];
        $query = "SELECT
            aa.animal_id,
            a.name 'animal_name',
            a.type,
            aa.date_adopted,
            a.gender,
            DATEDIFF(CURRENT_DATE, a.dob) / 365 'age',
            u.name 'adopter',
            u.telephone 'adopter_contact',
            (SELECT count(*) FROM routine_updates r WHERE r.animal_id = aa.animal_id) 'update_count',
            (SELECT max(update_date) FROM routine_updates r WHERE r.animal_id = aa.animal_id) 'last_updated'
        FROM
            animal_for_adoption aa,
            animal a,
            user u
        WHERE
            aa.user_id = u.user_id AND a.animal_id = aa.animal_id and aa.org_id = :org_id;";
        return BaseModel::select($query, ["org_id" => $org_id]);
    }

    static function rescue_to_adoption_report()
    {
        $org_id = $_SESSION['org_id'];

        $query = "SELECT
            aa.animal_id,
            a.name 'animal_name',
            a.type,
            aa.date_adopted,
            a.gender,
            DATEDIFF(CURRENT_DATE, a.dob) / 365 'age',
            u.name 'adopter',
            u.telephone 'adopter_contact',
            (SELECT count(*) FROM routine_updates r WHERE r.animal_id = aa.animal_id) 'update_count',
            (SELECT max(update_date) FROM routine_updates r WHERE r.animal_id = aa.animal_id) 'last_updated'
        FROM
            animal_for_adoption aa,
            animal a,
            user u
        WHERE
            aa.user_id = u.user_id AND a.animal_id = aa.animal_id and aa.org_id = :org_id;";
        return BaseModel::select($query, ["org_id" => $org_id]);
    }

    static function rescues_information_report()
    {
        $org_id = $_SESSION['org_id'];
        $query = "SELECT
            rr.report_id,
            rr.type,
            rr.time_reported,
            rr.accepted_date,
            ra.rescued_date,
            (SELECT TIMESTAMPDIFF(hour, time_reported, accepted_date)) AS reported_to_accepted,
            (SELECT TIMESTAMPDIFF(hour, accepted_date, rescued_date)) AS accepted_to_rescued,
            (SELECT (reported_to_accepted) + (accepted_to_rescued)) AS total_time
        FROM
            report_rescue rr,
            rescued_animal ra
        WHERE
            rr.report_id = ra.report_id AND rr.org_id = :org_id;";
        return BaseModel::select($query, ["org_id" => $org_id]);
    }

    static function donations_summary_report()
    {
        $org_id = $_SESSION['org_id'];
        $query = "SELECT * from adoption_request WHERE org_id = '$org_id' ";
        return BaseModel::select($query);
    }
}
