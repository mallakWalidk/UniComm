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
        $query = 'SELECT DISTINCT m.sender_id, m.reciever_id FROM ' . $this->table_name . ' as m 
        INNER JOIN users as u
        ON u.id = m.reciever_id OR u.id = m.sender_id
        WHERE m.reciever_id = ? OR m.sender_id = ?
        ORDER BY m.timestamp DESC';
        $stmt = $this->conn->prepare($query);
        $this->reciever_id = htmlspecialchars(strip_tags($this->reciever_id));
        $this->sender_id = htmlspecialchars(strip_tags($this->sender_id));
        $stmt->bind_param('ss', $this->reciever_id, $this->sender_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (user_id, post_id) VALUES (?,?)';
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $stmt->bind_param('ss',
                           $this->user_id,
                           $this->post_id);
        if ( $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE user_id = ? AND post_id = ?';
        $stmt = $this->conn->prepare($query);
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->post_id = htmlspecialchars(strip_tags($this->post_id));
        $stmt->bind_param('ss',
                           $this->user_id,
                           $this->post_id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    
}



?>