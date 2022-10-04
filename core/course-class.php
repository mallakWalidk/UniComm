<?php 

class Course  
{
    private $conn;
    private $table_name = 'courses';

    public $id;
    public $faculty;
    public $department;
    public $course_name;
    public $subject_name;
    public $file;
    public $author_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT course_name, subject_name, u.name, file FROM ' . $this->table_name . ' as c
                  INNER JOIN users as u
                  ON u.id = c.author_id
                  WHERE c.department = ?';
        $stmt = $this->conn->prepare($query);
        $this->department = htmlspecialchars(strip_tags($this->department));
        $stmt->bind_param('s', $this->department);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('s', $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_assoc();
        return $row;
    }

    public function read_by_uid()
    {
        $query = 'SELECT course_name, subject_name, u.name, file, c.id FROM ' . $this->table_name . ' as c
        INNER JOIN users as u
        ON u.id = c.author_id
        WHERE c.department = ? AND c.author_id = ?';
        $stmt = $this->conn->prepare($query);
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->department = htmlspecialchars(strip_tags($this->department));
        $stmt->bind_param('ss', $this->department, $this->author_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (course_name, subject_name, file, author_id, faculty, department)
                  VALUES (?,?,?,?,?,?)';
        $stmt = $this->conn->prepare($query);
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->subject_name = htmlspecialchars(strip_tags($this->subject_name));
        $this->file = htmlspecialchars(strip_tags($this->file));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->faculty = htmlspecialchars(strip_tags($this->faculty));
        $this->department = htmlspecialchars(strip_tags($this->department));
        $stmt->bind_param('ssssss',
                           $this->course_name,
                           $this->subject_name,
                           $this->file,
                           $this->author_id,
                           $this->faculty,
                           $this->department
                        );
        if ( $stmt->execute()) {
            return true;
        } else {
            return false;
        }
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