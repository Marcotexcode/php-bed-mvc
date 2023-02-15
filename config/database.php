<?php 


// Imposta i dati di collegamento al nostro DB. 

return [
    'driver'    => 'mysql', 
    'host'      => 'localhost',
    'user'      => 'root',
    'password'  => '',
    'database'  => 'php_bed_db',
    'pdooptions'=> [
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ], 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ]
];