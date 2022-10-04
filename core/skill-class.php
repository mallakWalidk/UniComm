<?php 

class Skill  
{
    private $conn;
    private $table_name = 'skills';

    public $id;
    public $user_id;
    public $name;
    public $value;
   

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE user_id = ?';
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $stmt->bind_param('s', $this->user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (user_id, name, value) VALUES ';
        for ($i=0; $i < count($this->name); $i++) { 
            $v1 = htmlspecialchars(strip_tags($this->user_id));
            $v2 = htmlspecialchars(strip_tags($this->name[$i]));
            $v3 = htmlspecialchars(strip_tags($this->value[$i]));
            if ($i == count($this->name) - 1 || count($this->name) == 1) {
                $query .= "('{$v1}','{$v2}','{$v3}') ";
            } else {
            $query .= "('{$v1}','{$v2}','{$v3}'), ";
            }
        }
        $result = $this->conn->query($query);
        
        return $result;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('s', $this->id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    
}



?>