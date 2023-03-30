<?php 

class Page extends Database {
    function __construct()
    {
        parent::__construct();
    } 
    public function setup()
    {
        try {
            $page_table = "CREATE TABLE IF NOT EXISTS page (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(50) UNIQUE NOT NULL,
                content VARCHAR(250) NOT NULL,
                time_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                user_id INT(11) UNSIGNED NOT NULL, 
                CONSTRAINT `fk_user`
                 FOREIGN KEY (user_id)
                 REFERENCES user(id) 
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $statement = $this->db->prepare($page_table);
        } catch (\Throwable $th) {
            throw $th;
        }
        return $statement ->execute();
    }

    public function all_pages(){
        $sql = "SELECT * FROM page";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function one_page($id){
        $sql = "SELECT * FROM page WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create_page($title, $content, $user_id) 
    {
    try {
        //code...
        $sql = "INSERT INTO page (title, content, user_id) VALUES (:title, :content, :user_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

        return $stmt->execute();


    } catch (\Throwable $th) {
        throw $th;
    }
}


public function delete_page($id)
{
    $sql = "DELETE FROM page WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
} 


public function edit_page($id, $title, $content)
{
    $sql = "UPDATE page SET title = :title, content = :content WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    return $stmt->execute();
}

}
