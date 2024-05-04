<?php

namespace database;

class DB
{
    public static function connect(): \mysqli
    {
        return new \mysqli(
            '127.0.0.1',
            'root',
            '',
            'sib-01',
        );
//        return mysqli_connect(
//            '127.0.0.1',
//            'root',
//            '',
//            'sib-01',
//        );
    }
}