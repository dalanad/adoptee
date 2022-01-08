<?php
class BaseModel
{
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {

            $dsn = config::get("db.dsn");
            $user = config::get("db.user");
            $pass = config::get("db.pass");

            $db = new PDO($dsn, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // charset is set to utf8mb4_unicode_ci to support UNICODE such as emoji 🐕‍🦺
            $db->exec("set names utf8mb4");
        }

        return $db;
    }

    protected static function select($query, $params = [])
    {

        $db = self::getDB();
        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return  $result;
    }

    protected static function selectOne($query, $params = [])
    {
        $db = self::getDB();
        $stmt = $db->prepare($query . " LIMIT 1");
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result == false ? null : $result;
    }

    protected static function insert($query, $params = [])
    {
        $db = self::getDB();
        $stmt = $db->prepare($query);
        return $stmt->execute($params);
    }

    protected static function update($query, $params = [])
    {
        $db = self::getDB();
        $stmt = $db->prepare($query);
        return $stmt->execute($params);
    }

    protected static function lastInsertId($var = null)
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
