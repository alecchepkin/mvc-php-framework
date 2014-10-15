<?php

class PostModel {

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getAllPosts($limit = null) {
        $sql = "SELECT id, title, body, date_created FROM post ORDER BY id DESC";
        if($limit){
            $sql.=" LIMIT $limit";
        }
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getPost($post_id) {
        $sql = "SELECT id, title, body, date_created FROM post WHERE id='$post_id' LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    /**
     * Add a post to database
     * @param string $title Title
     * @param string $body Body
     */
    public function addPost($title, $body) {
        $title = strip_tags($title);
        $title = substr($title, 0, 50);
        $body = strip_tags($body);

        $sql = "INSERT INTO post (title, body) VALUES (:title, :body)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':title' => $title, ':body' => $body));
    }

    /**
     * Delete a post in the database
     * @param int $post_id Id of post
     */
    public function deletePost($post_id) {
        $sql = "DELETE FROM post WHERE id = :post_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':post_id' => $post_id));
    }

}
