<?php

class SponsorshipTier extends BaseModel
{
    static function createSponsorshipTier($name,$amount,$description)
    {
        $query = "INSERT INTO `sponsorship_tier` (   `name`, `amount`, `description`) 
                  VALUES ('$name',$amount,'$description' )";
        return BaseModel::insert($query);
    }
}
?>