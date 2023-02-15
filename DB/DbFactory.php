<?php

namespace App\DB;

    use App\DB\DBPDO;
    use InvalidArgumentException;

    /**
     *  Si potrebbe creare un pattern factory 
     *  per crearci un tipo di connsessione al Database a seconda del driver (mysql,sqllite,mssql,oci....) che utilizziamo
     *  quindi in questo caso in una factory possiamo predisporre  gia il collegamento al database 
     *  a seconda del driver, ad esempio per sqllite è diverso da mysql perche in sqllite 
     *  non esiste host ma solo il file di configurazione.
     */

    class DbFactory {
     
        public static function create(array $options)
        {
            if (!array_key_exists('dsn', $options)) {

                if (! array_key_exists('charset', $options)) {
                    $options['charset'] = 'utf8';
                }

                if (! array_key_exists('driver', $options)) {
                    throw new InvalidArgumentException('Nessun driver trovato');
                }

                $dsn = '';

                switch ($options['driver']) {
                    case 'mysql': 
                    case 'oracle':
                    case 'mssql':
                        $dsn = $options['driver'] . ':host=' . $options['host'] . ';dbname=' . $options['database'] . ';charset=' . $options['charset']; // Nel caso di mysql.
                        break;
                    case 'sqlite': 
                        $dsn = 'sqllite:' . $options['database'];
                        break;
                    default:
                        throw new InvalidArgumentException('Driver non conosciuto'); 
                }

                $options['dsn'] = $dsn;
            }

            return DBPDO::getInstance($options);

        }
    }
    