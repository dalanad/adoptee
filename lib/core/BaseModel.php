<?php
class BaseModel
{
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $db_host = getenv("DB_HOST");
            $dsn = "mysql:host=$db_host;dbname=adoptee;charset=utf8";

            $db = new PDO($dsn, "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }


        return $db;
    }

    public static function select($query, $params = [])
    {

        $db = BaseModel::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return  $result;
    }

    public static function insert($query, $params = [])
    {

        $db = BaseModel::getDB();
        $stmt = $db->prepare($query);
        return $stmt->execute($params);
    }

    public static function update($query, $params = [])
    {
        $db = BaseModel::getDB();
        $stmt = $db->prepare($query);
        return $stmt->execute($params);
    }

    public static function lastInsertId($var = null)
    {
        return self::getDB()->lastInsertId($var);
    }

    public static function beginTransaction()
    {
        return self::getDB()->beginTransaction();
    }

    public static function commit()
    {
        return self::getDB()->commit();
    }

    public static function rollBack()
    {
        return self::getDB()->rollBack();
    }
}
