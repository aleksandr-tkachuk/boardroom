<?php

define('BASE_PASS', realpath(__DIR__ . '/..') . '/');

define("TYPE_DB", "mysql");

$config = [
    "db" => [
        "type" => TYPE_DB,
        "mysql" => [
            "driver" => "mysql",
            "host" => "localhost",
            /*	"username" => "user13",
               "password" => "tuser13",
               "dbname" => "user13",*/
            "username" => "root",
            "password" => "123456",
            "dbname" => "boardroom",
            "charset" => "utf8"
        ]
    ],
    "db_test" => [
        "type" => TYPE_DB,
        "mysql" => [
            "driver" => "mysql",
            "host" => "localhost",
            /*	"username" => "user13",
               "password" => "tuser13",
               "dbname" => "user13",*/
            "username" => "root",
            "password" => "",
            "dbname" => "boardroom_test",
            "charset" => "utf8"
        ],
    ]
];

