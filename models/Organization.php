<?php

class Organization extends BaseModel
{
    public static function registerOrganization($name, $email, $telephone, $address_line_1, $address_line_2, $city, $password)
    {
        User::createUser($name,  $email, $telephone, $address_line_1 . " " . $address_line_2,  $password);
        $user_id = self::lastInsertId();

        $query = "INSERT INTO organization (name, telephone, address_line_1, address_line_2, city) 
                  VALUES ('$name', $telephone, '$address_line_1', '$address_line_2', '$city')";
        self::insert($query);
        $org_id = self::lastInsertId();

        $query = "INSERT INTO org_user (user_id, org_id, role) VALUES ('$user_id', '$org_id', 'ADMIN');";
        self::insert($query);
    }

    public static function updateOrgInfo($orgId, $data)
    {
        $updateQuery = "UPDATE `organization` 
            SET `name` = :name,
                `telephone` = :telephone,
                `address_line_1` = :address_line_1,
                `address_line_2` = :address_line_2,
                `city` = :city,
                `tagline` = :tagline,
                `logo` = :logo,
                `about` = :about,
                `about_photo` = :about_photo,
                `location_coordinates` = POINT(:lat ,:lang)
            WHERE `organization`.`org_id` = :org_id
        ";
        self::update($updateQuery, [
            "org_id" => $orgId,
            "name" => $data["name"],
            "telephone" => $data["telephone"],
            "address_line_1" => $data["address_line_1"],
            "address_line_2" => $data["address_line_2"],
            "city" => $data["city"],
            "tagline" => $data["tagline"],
            "logo" => $data["logo"],
            "about" => $data["about"],
            "about_photo" => $data["about_photo"],
            "lat" => $data["location_lat"],
            "lang" => $data["location_lang"],
        ]);
    }

    public static function getOrgUsers($orgId)
    {
        $query = "SELECT u.*, ou.* FROM user u, org_user ou WHERE u.user_id=ou.user_id AND ou.org_id = $orgId";
        return self::select($query);
    }

    public function getOrgListing()
    {
        $query = "SELECT * FROM `organization`";
        return BaseModel::select($query);
    }

    public function getOrgDetails($orgId)
    {
        $query = "SELECT 
                        o.*, 
                        st_y(location_coordinates) as location_lang, 
                        st_x(location_coordinates) as location_lat 
                    FROM `organization` o WHERE org_id = $orgId";
        return BaseModel::select($query);
    }

    public function getOrgAnimalsForAdoption()   //function not used
    {
        $query = "SELECT animal_id, type, gender FROM `animal_for_adoption`, `organization`
        WHERE `animal_for_adoption`.org_id = `organization`.org_id";
        return BaseModel::select($query);
    }

    static function findOrgById($orgId)
    {
        $query = "SELECT 
                    o.*, 
                    st_y(location_coordinates) as location_lang, 
                    st_x(location_coordinates) as location_lat 
                  FROM `organization` o WHERE org_id = $orgId";
        return BaseModel::select($query);
    }

    static function getOrgContent($orgId)
    {
        $query = "SELECT * FROM `org_content` WHERE org_id = $orgId";
        return BaseModel::select($query);
    }

    static function getOrgAdoptions($orgId)
    {
        $query = "SELECT *, DATEDIFF(CURRENT_DATE, animal.dob)/365 'age'
        FROM `animal_for_adoption`, `animal` WHERE animal_for_adoption.org_id = $orgId
        AND animal.animal_id = animal_for_adoption.animal_id";
        return BaseModel::select($query);
    }

    static function getOrgMerchandise($orgId)
    {
        $query = "SELECT * FROM `org_merch_item` WHERE org_merch_item.org_id = $orgId";
        return BaseModel::select($query);
    }

    static function getOrgSponsorships($orgId)
    {
        $query = "SELECT sponsorship_tier.*, o.org_id
        FROM `sponsorship_tier`, `organization` o 
        WHERE sponsorship_tier.org_id = $orgId
        AND o.org_id = $orgId AND sponsorship_tier.status = 'ACTIVE'";
        return BaseModel::select($query);
    }

    static function makeDonation($name, $email, $receipt, $subscriptionId) //changes to be made
    {
        $query = "INSERT INTO `donation` (`name`, `email`, `receipt`)
                  VALUES('$name', '$email', $receipt);";
        self::insert($query);
    }

    static function writeReview($living_conditions,$healthcare,$rescue_response,$adoptions,$resource_allocation,$comment,$name,$email,$org_id,$userid)
    {
        $query = "INSERT INTO 
        org_feedback(org_id,user_id,living_conditions,healthcare,rescue_response,adoptions,resource_allocation,comments,name,email)
        VALUES($org_id,$userid,$living_conditions,$healthcare,$rescue_response,$adoptions,$resource_allocation,'$comment',$name,$email)";
        self::insert($query);

        $rating = (self::select("SELECT rating FROM organization WHERE org_id=$org_id"))[0]['rating'];
        $count = (self::select("SELECT COUNT(*) FROM org_feedback WHERE org_id=$org_id"))[0]['COUNT(*)'];
        $add_rate = ($living_conditions+$healthcare+$rescue_response+$adoptions+$resource_allocation)/5;
        $rating = ( ($rating*($count-1) ) + $add_rate)/$count;

        $query = "UPDATE organization SET rating = $rating WHERE org_id = $org_id";
        return self::insert($query);
        // print_r($query);
    }

    public static function getAllFeedback($orgId)
    {
        $query = "SELECT * FROM `org_feedback`, user WHERE user.user_id = org_feedback.user_id AND org_id = :org_id";
        return self::select($query, ["org_id" => $orgId]);
    }

    public static function acknowledgeFeedback($orgId, $userId, $time)
    {
        $query = "UPDATE `org_feedback` SET acknowledged = 1 WHERE user_id =:user_id AND org_id = :org_id AND created_time = :time";
        return self::select($query, ["org_id" => $orgId, "time" => $time, "user_id" => $userId]);
    }

}
