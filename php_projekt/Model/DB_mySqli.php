<?php 

class DB_mySqli extends mysqli {

    private static $instance;

    public function __construct()
    {
        require 'login.php';
        parent::__construct($hn,$un,$pw,$db); 
        
    }

    public static function getInstance() : self {
        if(self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

?>