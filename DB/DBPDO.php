<?php

    namespace App\DB;
    use PDO;
    // Creare una classe pattern singleton che ci permetta di collegarci al db. 
    class DBPDO {

        // Creo  una proprieta protected per la connessione. 
        protected PDO $conn;

        // Proprieta per avere un instanza di questa classe.
        // la impostiamo static cosi esistera per qualunque oggetto di questa classe. 
        protected static $instance;

         // Creiamo un costruttore protected. 
        // Qui dentro andremo a costruire la nosta connessione al DB. 
        // Come parametro gli passeremo le opzioni per collegarsi al DB. 
        protected function __construct(array $options)
        {
            // Imposto la connesione passadogli le opzioni per collegarsi al DB.  
            $this->conn = new \PDO($options['dsn'],$options['user'],$options['password']);
        }
        
        // Creo un metodo che riceve un array di opzioni, che sarebbero le opzioni del collegamento al DB. 
        public static function getInstance(array $options)
        {
            // Se la variabile instance non è settata.
            if (!static::$instance) {
                // Allora impostiamo a instance il nome della classe passandogli le opzioni. 
                static::$instance = new static($options); // In questo modo e come se scrivi new DBPDO($optioin)
            }

            // Alla fine faccio il retur dell' instanza.
            return static::$instance;
        }

        // Creo un metodo pubblico per accedere alla connessione. 
        public function getConn()
        {
            // Ritorniamo la connessione.
            return $this->conn;
        }
    }



    /**
     * Nell'ingegneria del software il pattern Singleton è utilizzato per limitare ad una sola 
     * le istanze di un oggetto. Questo è utile quando è necessario avere esattamente un'unica 
     * istanza di un oggetto per coordinare le azioni all'interno del proprio sistema, 
     * oppure quando si hanno degli aumenti di efficienza condividendo una sola istanza. 
     * L'utilizzo del pattern Singleton permette l'eliminazione delle variabili globali che, 
     * dovendo sottostare alle rigide regole di soping dei linguaggi di programmazione, 
     * sono ormai ritenute una pratica obsoleta che dovrebbe cadere in disuso; eliminando 
     * l'utilizzo delle variabili globali avremo la possibilità di scrivere codice più ordinato, 
     * facilmente manutenibile e meno propenso agli errori.
     */