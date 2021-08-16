<?php
class BaseModel
{
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=;dbname=adoptee;charset=utf8';

            $db = new PDO($dsn, "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }


        return $db;
    }

    public static function select($query)
    {

        $db = BaseModel::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return  $result;
    }

    public static function insert($query)
    {

        $db = BaseModel::getDB();
        $stmt = $db->prepare($query);
        return $stmt->execute();
    }
}
