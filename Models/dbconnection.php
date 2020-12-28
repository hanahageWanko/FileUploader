<?php
require __DIR__ . '/database.php';
class CreateDBinstance
{
    public function dbInstanceConnection()
    {
        $db_connection = new Database();
        return $db_connection->dbConnection();
    }

    public function setContent()
    {
        return json_decode(file_get_contents("php://input"));
    }

    public function insert($table, $value, $targetInstance)
    {
        $query ="INSERT INTO $table" . "(". $value .")" . "VALUES (:". $value .")";
        $insertStmt = $this->dbInstanceConnection();
        $insertStmt = $insertStmt->prepare($query);
        $insertStmt->bindValue(':image_name', htmlspecialchars(strip_tags($targetInstance->getTargetFile())), PDO::PARAM_STR);
        echo $insertStmt->execute() ? $targetInstance->errorMessage(0) : $targetInstance->errorMessage(4);
    }
}
