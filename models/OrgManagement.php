<?php

class OrgManagement extends BaseModel
{
    static public function getDashboardData()
    {

        $org_id = $_SESSION["org_id"];

        $male_adoptees_query = "SELECT animal.type, COUNT(animal.type) as total FROM animal,animal_for_adoption 
            WHERE animal.gender = 'MALE' 
            AND animal_for_adoption.animal_id=animal.animal_id 
            AND animal_for_adoption.org_id = $org_id
            GROUP BY animal.type ORDER BY animal.type;";

        $female_adoptees_query = "SELECT animal.type, COUNT(animal.type) as total FROM animal,animal_for_adoption 
            WHERE animal.gender = 'MALE' 
            AND animal_for_adoption.animal_id=animal.animal_id 
            AND animal_for_adoption.org_id = $org_id
            GROUP BY animal.type;";

        $adoption_requests_query = "SELECT animal.type, COUNT(adoption_request.animal_id) as total 
            FROM animal,adoption_request 
            WHERE adoption_request.animal_id=animal.animal_id AND adoption_request.org_id = $org_id 
            GROUP BY animal.type ;";

        $rescues_query = "SELECT report_rescue.type, COUNT(rescued_animal.report_id) as total 
            FROM animal,rescued_animal,report_rescue 
            WHERE rescued_animal.report_id=report_rescue.report_id AND rescued_animal.org_id = $org_id
            GROUP BY report_rescue.type";

        $sponsorship_12_month = "SELECT YEAR(p.txn_time), MONTH(p.txn_time) mon, SUM(p.amount) 'total' 
            FROM donation d, payment p 
            WHERE d.txn_id = p.txn_id AND p.txn_time BETWEEN NOW() - INTERVAL 12 MONTH AND NOW() 
            AND d.subscription_id IS NOT NULL AND d.org_id = $org_id 
            GROUP BY YEAR(p.txn_time), MONTH(p.txn_time) ORDER BY YEAR(p.txn_time), MONTH(p.txn_time)";

        $donation_12_month = "SELECT YEAR(p.txn_time), MONTH(p.txn_time) mon, SUM(p.amount) 'total' 
            FROM donation d, payment p 
            WHERE d.txn_id = p.txn_id AND p.txn_time BETWEEN NOW() - INTERVAL 12 MONTH AND NOW() 
            AND d.subscription_id IS NULL AND d.org_id = $org_id
            GROUP BY YEAR(p.txn_time), MONTH(p.txn_time) ORDER BY YEAR(p.txn_time), MONTH(p.txn_time)";

        $total_donations_query = "SELECT SUM(payment.amount) 'total' FROM donation, payment WHERE donation.txn_id = payment.txn_id AND donation.org_id =  $org_id;";
        $sponsorship_total = "SELECT sum(s.amount_at_subscription) 'total' FROM sponsorship s WHERE s.org_id = $org_id";
        $total_rescues_query = "SELECT COUNT(report_id) 'total' FROM rescued_animal AS total_rescues WHERE org_id = $org_id;";


        $data = [
            "male_adoptees" => self::processAnimalTypeData($male_adoptees_query),
            "female_adoptees" => self::processAnimalTypeData($female_adoptees_query),
            "donations" => self::last12Months($donation_12_month),
            "sponsorships" => self::last12Months($sponsorship_12_month),
            "adoption_requests" => self::processAnimalTypeData($adoption_requests_query),
            "rescues" => self::processAnimalTypeData($rescues_query),
            "total_donations" => self::select($total_donations_query)[0]['total'],
            "total_sponsorships" => self::select($sponsorship_total)[0]['total'],
            "total_rescues" => self::select($total_rescues_query)[0]['total']
        ];
        return $data;
    }

    // return data in an array with the order cats, dogs, other
    static function processAnimalTypeData($query)
    {
        $result = self::select($query);

        $data = [];
        $animal_types = ['cat', 'dog', 'other'];
        $j = 0;
        for ($i = 0; $i < 3; $i++) {

            if (isset($result[$j]) && strtolower($animal_types[$i]) == strtolower($result[$j]["type"])) {
                array_push($data, $result[$j]["total"]);
                $j++;
            } else {
                array_push($data, 0);
            }
        }
        return $data;
    }

    // process data to add missing months to the last 12 month data
    static function last12Months($query)
    {
        $result = self::select($query);
        $data = [];
        $j = 0;
        for ($i = 11; $i >= 0; $i--) {
            $mon = date("m", strtotime(date('Y-m-01') . " -$i months"));

            if (isset($result[$j]) && $mon == $result[$j]["mon"]) {
                array_push($data, $result[$j]["total"]);
                $j++;
            } else {
                array_push($data, 0);
            }
        }
        return $data;
    }

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

    static function findAnimalsByOrgId($filter)
    {
        $org_id = $_SESSION['org_id'];
        $query = "SELECT animal.animal_id, name,type, other, color, dob, 
        FLOOR(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age', gender,
        date_listed,status,date_adopted,description, 
        animal.photo as avatar_photo,
        animal_for_adoption.photos as adoptee_photo
        from animal_for_adoption,animal 
            where org_id= $org_id 
            and animal.animal_id=animal_for_adoption.animal_id ";

        //filters
        //status
        $status = $filter["status"];
        if ($status != "ANY") {
            $query = $query . " AND animal_for_adoption.status ='$status' ";
        }

        //sort
        $sort = $filter['sort'];
        $order = $filter['order'];
        if (isset($sort) && $sort != "date_listed") {
            $query = $query . " ORDER BY $sort $order ";
        }

        return BaseModel::select($query);
    }


    static function editAnimalData($animal_id, $status, $name, $type, $gender, $dob, $description, $photo, $photos)
    {

        /*         $query = "INSERT INTO `animal_for_adoption` (photo)
        VALUES ('$photo')";
        echo($query);
        BaseModel::insert($query); */

        $query = "UPDATE `animal_for_adoption` SET status = '$status' name = '$name' type = $type gender = '$gender' SET dob = '$dob' photo = '$photo' WHERE animal.animal_id = '$animal_id';
        UPDATE `animal_for_adoption` SET description = '$description' photos = '$photos' animal_for_adoption.animal_id = '$animal_id'";

        return BaseModel::insert($query);
    }

    static function delete_animal($animal_id)
    {
        $query = "UPDATE `animal_for_adoption` SET status = 'DELETED' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function findRequestsByOrgId($filter)
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
        WHERE org_id = '$_SESSION[org_id]' ";

        //filters
        //status
        $status = $filter["status"];
        if ($status != "ANY") {
            $query = $query . " AND adoption_request.status ='$status' ";
        }

        //sort
        $sort = $filter['sort'];
        $order = $filter['order'];
        if (isset($sort) && $sort != "request_date") {
            $query = $query . " ORDER BY $sort $order ";
        }

        return BaseModel::select($query);
    }

    static function findUpdates($animal_id, $user_id)
    {
        $query = "SELECT 
        routine_updates.animal_id, 
        routine_updates.user_id,
        routine_updates.type, 
        routine_updates.photo, 
        routine_updates.description,
        routine_updates.update_date
        from routine_updates
        INNER JOIN animal ON
            routine_updates.animal_id = animal.animal_id
        INNER JOIN user ON
            user.user_id = routine_updates.user_id
        WHERE routine_updates.animal_id='$animal_id' AND routine_updates.user_id = '$user_id'";
        return BaseModel::select($query);
    }

    static function accept_adoption_request($animal_id, $user_id)
    {
        self::beginTransaction();
        self::insert("UPDATE `adoption_request` SET status = 'ADOPTED' WHERE animal_id='$animal_id' AND user_id = '$user_id';");
        self::insert("INSERT INTO `user_pet`(`animal_id`, `user_id`) VALUES('$animal_id','$user_id');");
        self::insert("UPDATE `animal_for_adoption` SET status = 'ADOPTED', date_adopted = curdate(), user_id = '$user_id' WHERE animal_id='$animal_id'");
        self::commit();
    }

    static function reject_adoption_request($animal_id)
    {
        $query = "UPDATE `adoption_request` SET status = 'REJECTED' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function mark_as_complete($report_id)
    {

        $query = "UPDATE `report_rescue` SET status = 'RESCUED' WHERE report_id=$report_id;
        INSERT INTO `rescued_animal`(`org_id`, `report_id`, `rescued_date`) VALUES(" . $_SESSION['org_id'] . ",'$report_id', curdate());";

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

    static function findRescuedAnimalsByOrgId($filter)
    {
        $org_id = $_SESSION['org_id'];

        $query = "SELECT * from report_rescue, rescued_animal WHERE report_rescue.report_id = rescued_animal.report_id AND rescued_animal.org_id = '$org_id' ";

        //sort
        $sort = $filter['sort'];
        $order = $filter['order'];
        if (isset($sort) && $sort != "rescued_date") {
            $query = $query . " ORDER BY $sort $order ";
        }


        return BaseModel::select($query);
    }

    static function add_rescue_update($report_id, $org_id, $heading, $description, $photo)
    {
        $query = "INSERT INTO `rescue_updates` (`report_id`, `org_id`, `heading`, `description`, `photos`, `time_updated`)
        VALUES ('$report_id','$org_id', '$heading', '$description', '$photo', current_timestamp())";
        return BaseModel::insert($query);
    }

    static function findOrgContentByOrgId($filter)
    {
        $org_id = $_SESSION['org_id'];
        $sort_column = $filter["sort"];
        $sort_direction = $filter["order"];

        $query = "SELECT * from org_content WHERE org_id = '$org_id' ";

        if(isset($filter["search"])){
            $search = $filter["search"];
            $query = $query . "AND (description like '%$search%' OR heading like '%$search%') ";
        }

        $query = $query . (isset($filter) ? (" ORDER BY $sort_column $sort_direction") : '' );

        return BaseModel::select($query);
    }

    static function add_new_event($org_id, $heading, $description, $photos)
    {
        $query = "INSERT INTO `org_content` (org_id, created_time, heading, description, photos)
        VALUES ('$org_id', CURRENT_TIMESTAMP, '$heading', '$description', '$photos')";

        return BaseModel::insert($query);
    }

    static function update_news_event($item_id, $heading, $description, $photos)
    {
        $query = "UPDATE `org_content` SET heading = '$heading' description = '$description' photos = '$photos' created_time = curdate() WHERE item_id=$item_id;";

        return BaseModel::insert($query);
    }

    static function delete_news_event($item_id)
    {
        $query = "DELETE FROM org_content WHERE item_id=$item_id";

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

    static function animals_report($listed_from, $listed_to)
    {
        $org_id = $_SESSION['org_id'];

        $query = "SELECT animal.animal_id, animal.name,type, color, dob, 
        FLOOR(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age', gender,
        date_listed,status,date_adopted,description,
        animal_for_adoption.user_id as user_id,
        animal.name as name,  
        animal.photo as avatar_photo,
        u.name as adopter_name,
        u.telephone as adopter_tel
        from  animal, animal_for_adoption JOIN user u ON u.user_id = animal_for_adoption.user_id
            where org_id= $org_id "
            . (isset($listed_from) && $listed_from  != '' ? " AND date_listed > '$listed_from'" : '')
            . (isset($listed_to) && $listed_to  != '' ? " AND date_listed < '$listed_to'"  : '')
            . " and animal.animal_id=animal_for_adoption.animal_id ";
        return BaseModel::select($query);
    }

    static function adoptions_updates_report()
    {
        $org_id = $_SESSION['org_id'];
        $query = "SELECT
            aa.animal_id,
            a.photo as avatar_photo,
            a.name 'animal_name',
            a.type,
            aa.date_adopted,
            a.gender,
            FLOOR(DATEDIFF(CURRENT_DATE, a.dob) / 365) 'age',
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
            a.photo as avatar_photo,
            aa.date_adopted,
            aa.date_listed,
            aa.date_listed as date_rescued,
            a.gender,
            FLOOR(DATEDIFF(CURRENT_DATE, a.dob) / 365) 'age',
            (SELECT TIMESTAMPDIFF(day, date_rescued , aa.date_listed)) as rescued_to_listed,
            (SELECT TIMESTAMPDIFF(day, aa.date_listed , aa.date_adopted)) as listed_to_adopted,
            (SELECT TIMESTAMPDIFF(day, date_rescued , aa.date_adopted)) as rescued_to_adopted
        FROM
            animal_for_adoption aa,
            animal a
        WHERE
           a.animal_id = aa.animal_id and aa.org_id = :org_id;";
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

        $query = "SELECT
        px.txn_time,
        (SELECT COUNT(donation.txn_id) FROM donation GROUP BY txn_time) AS donation_count,
        (SELECT SUM(payment.amount) FROM donation GROUP BY txn_time) AS donation_amount,
        (SELECT COUNT(donation.subscription_id) FROM donation GROUP BY txn_time) AS subscription_count,
        (SELECT SUM(payment.amount) FROM donation GROUP BY txn_time) AS subscription_amount
    FROM
        donation,
        payment px
    WHERE
    donation.txn_id = px.txn_id AND donation.org_id = $org_id;";

        return BaseModel::select($query);
    }
}
