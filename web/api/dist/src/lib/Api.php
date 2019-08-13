<?
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Api {
    private $database;
    private $db;

    public function __construct() {
        $this->database = new Database('tippmixoddsinfo_mysql', 'tippmix_test', 'sanyi', '4l3x4nd3r');
        $this->db = $this->database->connect();
    }

    public function getCategories() {
        try {
            $sql = "SELECT * FROM sportcategories WHERE sportId IN (SELECT sportID FROM `mainevents`)";
            $stmt = $this->db->query($sql);
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }

    public function getAllMainEvents() {
        try {
            $sql = "SELECT * FROM mainevents";
            $stmt = $this->db->query($sql);
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }

    public function getChange($eventID, $limit) {
        try {
            $limit = isset($limit) ? $limit : 1844674407370;
            $sql = "SELECT * FROM changedodds WHERE eventID = :eventID ORDER BY ID DESC LIMIT 0, :limit";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':eventID', $eventID);
            $stmt->bindparam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }
}
