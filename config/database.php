<?php 


// Imposta i dati di collegamento al notro DB. 

// Utilizzando PDO Php Database Objects. 
// PDO.
return [
    'driver'    => 'mysql', // può essere sqllite,mssql, oci
    'host'      => 'localhost',
    'user'      => 'root',
    'password'  => 'root',
    'database'  => 'php_bed_db',
    'dsn'       => 'mysql:host=127.0.0.1;dbname=freeblog;charset=utf8',
    'options'   => [
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ], // FETCH_OBJ i dati vengono prelevati in object. 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ]
];