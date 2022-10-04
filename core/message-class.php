<?php 

class Message  
{
    private $conn;
    private $table_name = 'messages';

    public $id;
    public $sender_id;
    public $reciever_id;
    public $body;
    public $timestamp;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {   
        $query = "SELECT m1.*
        FROM messages m1 LEFT JOIN messages m2
         ON (m1.msg_id = m2.msg_id AND m1.id < m2.id)
        WHERE (m2.id IS NULL) AND (m1.sender_id = ? OR m1.reciever_id = ?) ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('ss',$this->id,$this->id);
        $stmt -> execute();
        $result = $stmt -> get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (sender_id, reciever_id, body, msg_id) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $this->sender_id = htmlspecialchars(strip_tags($this->sender_id));
        $this->reciever_id = htmlspecialchars(strip_tags($this->reciever_id));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->msg_id = htmlspecialchars(strip_tags($this->msg_id));
        $stmt->bind_param('ssss',
                           $this->sender_id,
                           $this->reciever_id,
                           $this->body,
                           $this->msg_id
                        );
        if ( $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read_chat()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE msg_id = ?';
        $stmt = $this->conn->prepare($query);
        $this->msg_id = htmlspecialchars(strip_tags($this->msg_id)); 
        $stmt->bind_param('s',$this->msg_id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function read_recent()
    {
        $query = 'SELECT body, timestamp FROM ' . $this->table_name . ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id)); 
        $stmt->bind_param('s',$this->id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_assoc();
        return $row;
    }

    public function read_msg_id()
    {
        $query = 'SELECT msg_id FROM ' . $this->table_name . ' WHERE sender_id = ? AND reciever_id = ? OR sender_id = ? AND reciever_id = ?';
        $stmt = $this->conn->prepare($query);
        $this->sender_id = htmlspecialchars(strip_tags($this->sender_id)); 
        $this->reciever_id = htmlspecialchars(strip_tags($this->reciever_id)); 
        $stmt->bind_param('ssss',
                            $this->sender_id,
                            $this->reciever_id,
                            $this->reciever_id,
                            $this->sender_id
        ); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_assoc();
        return $row;
    }


    
}



?>