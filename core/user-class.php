<?php 

class User  
{
    private $conn;
    private $table_name = 'users';

    public $id;
    public $name;
    public $email;
    public $gender;
    public $birth_date;
    public $phone;
    public $profile_pic;
    public $department;
    public $password;
    public $level; // students only
    public $type; // 0 => student 1 => professor 2 => admin
    public $active; // 0 => not active 1 => active

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id = ? OR email = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bind_param('ss', $this->id, $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        return $row;
    }

    public function read_by_dep()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE department = ?';
        $stmt = $this->conn->prepare($query);
        $this->department = htmlspecialchars(strip_tags($this->department));
        $stmt->bind_param('s', $this->department);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function read_by_keyword()
    {
        $query = 'SELECT id, name, profile_pic FROM ' . $this->table_name . ' WHERE name LIKE ? ORDER BY name LIMIT 10';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $stmt->bind_param('s', $this->name);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    public function update()
    {
        $query = 'UPDATE ' . $this->table_name . ' SET 
                  name = ?,
                  email = ?,
                  gender = ?,
                  birth_date = ?,
                  phone = ?,
                  department = ?,
                  password = ?,
                  level = ?,
                  type = ?,
                  profile_pic = ?
                  WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->department = htmlspecialchars(strip_tags($this->department));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->level = htmlspecialchars(strip_tags($this->level));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->profile_pic = htmlspecialchars(strip_tags($this->profile_pic));
        $stmt->bind_param('sssssssssss',
                           $this->name,
                           $this->email,
                           $this->gender,
                           $this->birth_date,
                           $this->phone,
                           $this->department,
                           $this->password,
                           $this->level,
                           $this->type,
                           $this->profile_pic,
                           $this->id );
        return $stmt->execute();
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (name, email, gender, phone, birth_date, department, password, level, type, profile_pic) 
                  VALUES (?,?,?,?,?,?,?,?,?)';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
        $this->department = htmlspecialchars(strip_tags($this->department));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->level = htmlspecialchars(strip_tags($this->level));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->profile_pic = htmlspecialchars(strip_tags($this->profile_pic));
        $stmt->bind_param('ssssssssss',
                           $this->name,
                           $this->email,
                           $this->gender,
                           $this->phone,
                           $this->birth_date,
                           $this->department,
                           $this->password,
                           $this->level,
                           $this->type,
                           $this->profile_pic
                        );
        if ( $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function set_active()
    {
        $query = 'UPDATE ' . $this->table_name . ' SET active = ? WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $this->active = htmlspecialchars(strip_tags($this->active));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('ss', $this->active, $this->id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    
}



?>