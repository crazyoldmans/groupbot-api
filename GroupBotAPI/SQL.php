<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13/04/2016
 * Time: 3:08 PM
 */

namespace GroupBotAPI;


class SQL
{
    /** @var  \PDO */
    private $db;

    public function __construct()
    {
        $this->db = $this->createPDO();
    }

    private function createPDO()
    {
        $pdo = new \PDO('mysql:host=' . BOT_DB_HOST . ';dbname=' . BOT_DB_NAME . ';charset=utf8', BOT_DB_USER, BOT_DB_PASSWORD);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }

    /**
     * @param $user_id
     * @return bool|mixed
     */
    public function getUserFromId($user_id)
    {
        $sql = 'SELECT user_id, user_name, first_name, last_name, balance, level FROM users
        WHERE user_id = :user_id';

        $query = $this->db->prepare($sql);
        $query->bindValue(':user_id', $user_id);
        $query->execute();

        if ($query->rowCount()) {
            //$query->setFetchMode(\PDO::FETCH_CLASS, 'GroupBot\Types\User');
            $out =  $query->fetch(MYSQLI_ASSOC);
            if (isset($out['queryString'])) unset($out['queryString']);
            return $out;
        }
        return false;
    }
}