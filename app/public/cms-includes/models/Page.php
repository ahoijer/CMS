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
                 ON DELETE CASCADE 
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $statement = $this->db->prepare($page_table);
        } catch (\Throwable $th) {
            throw $th;
        }
        return $statement ->execute();
    }

}

?>