<?

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password; 
    
    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        try {
            $dbConn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));
            $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConn;  
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        
    }
}