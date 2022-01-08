<?php

class SponsorshipTier extends BaseModel
{
    public static function createSponsorshipTier($orgId, $name, $amount, $description, $recurringDays)
    {
        $query = "INSERT INTO `sponsorship_tier` (`org_id`,`name`,`amount`,`description`,`recurring_days`) 
                  VALUES (:org_id,:name,:amount,:description, :recurring_days)";
        return self::insert($query, [
            "name" => $name,
            "amount" => $amount,
            "description" => $description,
            "org_id" => $orgId,
            "recurring_days" => $recurringDays
        ]);
    }

    public static function updateSponsorshipTier($orgId, $oldName, $name, $amount, $description, $recurringDays)
    {
        $query = "UPDATE `sponsorship_tier` SET 
                `name` = :name, 
                `amount` = :amount, 
                `recurring_days` = :recurring_days, 
                `description` = :description
            WHERE `sponsorship_tier`.`org_id` = :org_id AND `sponsorship_tier`.`name` = :old_name";

        return self::insert($query, [
            "amount" => $amount,
            "description" => $description,
            "name" => $name,
            "org_id" => $orgId,
            "old_name" => $oldName,
            "recurring_days" => $recurringDays
        ]);
    }

    public static function getAllByOrgId($orgId)
    {
        $query = "SELECT t.*, o.org_id FROM `sponsorship_tier` t, `organization` o 
                  WHERE t.org_id = o.org_id AND o.org_id = :org_id AND t.status = 'ACTIVE' ";
        return self::select($query, ["org_id" => $orgId]);
    }

    public static function getOneByOrgIdAndName($orgId, $name)
    {
        $query = "SELECT t.*, o.org_id FROM `sponsorship_tier` t, `organization` o 
                  WHERE t.org_id = o.org_id AND o.org_id = :org_id AND t.name = :name AND t.status = 'ACTIVE'";
        return self::selectOne($query, ["org_id" => $orgId, "name" => $name]);
    }

    public static function deleteSponsorshipTier($orgId, $name)
    {
        $query = "UPDATE `sponsorship_tier` SET `status` = 'INACTIVE' 
                    WHERE `sponsorship_tier`.`org_id` = :org_id AND `sponsorship_tier`.`name` = :name";

        return self::insert($query, ["name" => $name, "org_id" => $orgId]);
    }
}
