<?php
return array(
    'connectionString' => 'mysql:host=' . getenv('DB_HOST') . ';port=3306;dbname=' . getenv('DB_NAME'),
    'emulatePrepare' => true,
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8mb4',
    'tablePrefix' => 'tbl_',
);
