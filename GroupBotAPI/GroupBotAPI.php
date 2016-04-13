<?php

namespace GroupBotAPI;

require(__DIR__ . '/Settings.php');

class GroupBotAPI
{
    /** @var  SQL */
    private $SQL;

    public function __construct()
    {
        $this->SQL = new SQL();
        $this->start();
    }

    private function start()
    {
        $content = file_get_contents("php://input");
        $request = json_decode($content, true);

        if ($request) return $this->parseRequest($request);
        return $this->defaultRequest();
    }

    private function parseRequest($request)
    {
        if (isset($request['getUser'])) return $this->getUser($request['getUser']);
        echo json_encode(['error 1' => 'invalid request']);
        return true;
    }

    private function defaultRequest()
    {
        $arr = [
            'status' => 'online'
        ];
        echo json_encode($arr);
        return true;
    }

    private function getUser($user_id)
    {
        if ($user = $this->SQL->getUserFromId($user_id)) {
            echo json_encode($user);
            return true;
        }
        echo json_encode(['error 2' => 'cannot find user']);
        return false;
    }

}