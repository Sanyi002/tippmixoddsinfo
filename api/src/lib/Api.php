<?
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Api {
    private $database;
    private $db;

    public function __construct() { 
        $this->database = new Database(
            getenv('DB_HOST'),
            getenv('DB_NAME'),
            getenv('DB_USER'),
            getenv('DB_PASSWORD')
        );
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

    public function getDates() {
        try {
            $sql = "SELECT DISTINCT eventDate FROM mainevents";
            $stmt = $this->db->query($sql);
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }

    public function getCountries($sportID = null) {
        try {
            if(isset($sportID)) {
                $sql = "SELECT DISTINCT countryName FROM mainevents WHERE sportId = :sportID";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->execute();
            } else {
                $sql = "SELECT DISTINCT countryName FROM mainevents";
                $stmt = $this->db->query($sql);
            }
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }

    public function getEventsByDate($date) {
        try {
            $sql = "SELECT me.eventID, me.eventName, me.marketNumber, convert(me.eventDate, DATE) AS eventDate, sc.sportName,
            me.leagueName, me.homeOdds, me.drawOdds, me.awayOdds, co.homeOdds AS changedHomeOdds, co.drawOdds AS changedDrawOdds, co.awayOdds AS changedAwayOdds
            FROM mainevents me
            INNER JOIN sportcategories sc ON me.sportID = sc.sportID
            INNER JOIN (SELECT * FROM changedodds ch WHERE ch.ID IN (SELECT MAX(ID) FROM changedodds GROUP BY eventID)) co ON me.eventID = co.eventID
            WHERE convert(me.eventDate, DATE) = :selectedDate;";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':selectedDate', $date);
            $stmt->execute();
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

    public function getLeagues($sportID = null, $countryName = null) {
        $sqlBase = "SELECT DISTINCT leagueName FROM mainevents ";
        try {
            if(isset($sportID) && isset($countryName)) {
                $sql = $sqlBase . "WHERE sportID = :sportID and countryName = :countryName";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->bindparam(':countryName', $countryName);
                $stmt->execute();
            } elseif(isset($sportID)) {
                $sql = $sqlBase . "WHERE sportID = :sportID";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->execute();
            } elseif(isset($countryName)) {
                $sql = $sqlBase . "WHERE countryName = :countryName";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':countryName', $countryName);
                $stmt->execute();
            } else {
                $stmt = $this->db->query($sqlBase);
            }
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }

    public function getEvents($sportID = null, $selectedCountry = null, $selectedLeague = null,  $selectedDate = null) {
        $sqlBase = "SELECT me.eventID, me.eventName, me.marketNumber, convert(me.eventDate, DATE) AS eventDate, sc.sportName,
        me.leagueName, me.homeOdds, me.drawOdds, me.awayOdds, co.homeOdds AS changedHomeOdds, co.drawOdds AS changedDrawOdds, co.awayOdds AS changedAwayOdds
        FROM mainevents me
        INNER JOIN sportcategories sc ON me.sportID = sc.sportID
        INNER JOIN (SELECT * FROM changedodds ch WHERE ch.ID IN (SELECT MAX(ID) FROM changedodds GROUP BY eventID)) co ON me.eventID = co.eventID ";
        try {
            if(isset($sportID) && isset($selectedCountry) && isset($selectedLeague) && isset($selectedDate)) {
                $sql = $sqlBase . "WHERE me.sportID = :sportID AND me.countryName = :countryName
                    AND me.leagueName = :leagueName AND convert(me.eventDate, DATE) LIKE :selectedDate;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->bindparam(':countryName', $selectedCountry);
                $stmt->bindparam(':leagueName', $selectedLeague);
                $stmt->bindparam(':selectedDate', $selectedDate);
                $stmt->execute();
            } elseif(isset($sportID) && isset($selectedCountry) && isset($selectedLeague)) {
                $sql = $sqlBase . "WHERE me.sportID = :sportID AND me.countryName = :countryName AND me.leagueName = :leagueName;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->bindparam(':countryName', $selectedCountry);
                $stmt->bindparam(':leagueName', $selectedLeague);
                $stmt->execute();
            } elseif(isset($sportID) && isset($selectedCountry) && isset($selectedDate)) {
                $sql = $sqlBase . "WHERE me.sportID = :sportID AND me.countryName = :countryName AND convert(me.eventDate, DATE) LIKE :selectedDate;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->bindparam(':countryName', $selectedCountry);
                $stmt->bindparam(':selectedDate', $selectedDate);
                $stmt->execute();
            } elseif(isset($sportID) && isset($selectedCountry)) {
                $sql = $sqlBase . "WHERE me.sportID = :sportID AND me.countryName = :countryName";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->bindparam(':countryName', $selectedCountry);
                $stmt->execute();
            } elseif(isset($sportID) && isset($selectedDate)) {
                $sql = $sqlBase . "WHERE me.sportID = :sportID AND convert(me.eventDate, DATE) LIKE :selectedDate;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->bindparam(':selectedDate', $selectedDate);
                $stmt->execute();
            } elseif(isset($sportID)) {
                $sql = $sqlBase . "WHERE me.sportID = :sportID;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':sportID', $sportID);
                $stmt->execute();
            } else {
                $stmt = $this->db->query($sqlBase);
            }
            $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stmt;
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}';
        }
    }
}
