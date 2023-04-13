<?php 

class User extends Database {
    function __construct()
    {
        parent::__construct();
    } 
    public function setup()
    {
        try {
            $user_table = ("CREATE TABLE IF NOT EXISTS user (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) UNIQUE NOT NULL,
                password VARCHAR(100) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        
        $statement = $this->db->prepare($user_table);
        } catch (\Throwable $th) {
            throw $th;
        }
        return $statement ->execute();
    }

    public function login($username, $password) 
    {
        try {
            $user_query = "SELECT * FROM user WHERE username = '$username'";
            $stmt = $this->db->prepare($user_query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $_SESSION['message'] = "Username does not exists";
                header("location: login.php");
                exit();
            } else {
                $hash_from_db = $user['password'];
                $correct_password = password_verify($password, $hash_from_db);

                if(!$correct_password)
                {
                    $_SESSION['message'] = 'Invalid Password';
                    header('location: login.php');
                    exit();
                }

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['message'] = 'Sucessfully logged in';
                header('location: pages.php');
                exit();
            }
            } catch (\Throwable $th) {
            throw $th;
            }
        }

        public function register($username, $password) 
        {
        try {
            //code...
            $sql = "INSERT INTO user (username, password) VALUES (:username , :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
    
            return $this->db->lastInsertId();
    

        } catch (\Throwable $th) {
            throw $th;
        }
}


public function all_users(){
    $sql = "SELECT * FROM user";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function one_user($id){
    $sql = "SELECT * FROM user WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}

?>