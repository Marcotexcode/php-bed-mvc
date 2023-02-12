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

    // Creo classe pattern factory. 
    class DbFactory {
        /**
         * Creiamo un metodo statico che riceverà un array di opzioni che sarà simile 
         * a quella del singleto e in questo array andremo a fare uno switch a seconda del driver. 
         * (Della chiave driver che viene passata tramite l'array $options creato in database.php). 
         * Questa factory sta costruendo il dsn. 
         */
        public static function create(array $options)
        {
            // Se dentro l'array $option non esiste la chiave dsn, allora la creiamo.
            if (!array_key_exists('dsn', $options)) {

                 // Se non c'è il charset lo definiamo.
                 if (! array_key_exists('charset', $options)) {
                    $options['charset'] = 'utf8';
                }

                // Per prima cosa assicuriamoci che ci sia almeno una chiave driver.
                if (! array_key_exists('driver', $options)) {
                    //Allora solleveremo un eccezione con TrowExceptions
                    throw new InvalidArgumentException('Nessun driver trovato');
                }

                // Inizializzo una variabile che si chiama dsn.
                $dsn = '';

                // Creo uno switch che a seconda del driver costruiremo la stringa di connessione.
                switch ($options['driver']) {
                    case 'mysql': // Connessione valida per mysql.
                    case 'oracle': // Connessione valida per oracle. 
                    case 'mssql': // Connessione valida per mssql. 
                        $dsn = $options['driver'] . ':host=' . $options['host'] . ';dbname=' . $options['database'] . ';charset=' . $options['charset']; // Nel caso di mysql.
                        break;
                    case 'sqlite': // Invece per sqlite gli passiamo solo il database. 
                        $dsn = 'sqllite:' . $options['database']; // Nel caso di mysql.
                        break;
                    default:
                        throw new InvalidArgumentException('Driver non conosciuto'); // Di default eccezione. 
                }
                // Nell' array opzioni passo il dsn. 
                $options['dsn'] = $dsn;
            }

            // Passiamo l'array options con il dsn creato (se non è statocreato prima)
            // alla classe DBPDO.
            // Lo passiamo al medoto (della classe DBPDO) getInstance perche quella classe ha 
            // il costruttore protected essendo un sigleton. 
            return DBPDO::getInstance($options);

        }
    }
    