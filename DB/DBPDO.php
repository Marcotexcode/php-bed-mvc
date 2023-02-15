<?php

    namespace App\DB;
    use PDO;

    class DBPDO {

        protected PDO $conn;

        protected static $instance;

        protected function __construct(array $options)
        {
            $this->conn = new \PDO($options['dsn'],$options['user'],$options['password']);
        }
        
        public static function getInstance(array $options)
        {
            if (!static::$instance) {
                static::$instance = new static($options); 
            }

            return static::$instance;
        }

        public function getConn()
        {
            return $this->conn;
        }
    }

    /**
     * Nell'ingegneria del software il pattern Singleton è utilizzato per limitare ad una sola 
     * le istanze di un oggetto. Questo è utile quando è necessario avere esattamente un'unica 
     * istanza di un oggetto per coordinare le azioni all'interno del proprio sistema, 
     * oppure quando si hanno degli aumenti di efficienza condividendo una sola istanza. 
     * L'utilizzo del pattern Singleton permette l'eliminazione delle variabili globali, 
     * eliminando l'utilizzo delle variabili globali avremo la possibilità di scrivere codice più ordinato, 
     * facilmente manutenibile e meno propenso agli errori.
     */