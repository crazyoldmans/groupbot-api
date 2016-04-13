<?php

namespace GroupBotAPI;

/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13/04/2016
 * Time: 2:56 PM
 */
class GroupBotAPI
{

    public function __construct()
    {
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
}