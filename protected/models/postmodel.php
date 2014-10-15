<?php

class PostModel {

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all songs from database
     */
    public function getAllPosts() {
        $sql = "SELECT id, title, body, date_created FROM post ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Get all songs from database
     */
    public function getPost($post_id) {
        $sql = "SELECT id, title, body, date_created FROM post WHERE id='$post_id' LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // libs/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change libs/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        //return $query->fetchAll();
    }

    /**
     * Add a post to database
     * @param string $title Title
     * @param string $body Body
     */
    public function addPost($title, $body) {
        $title = strip_tags($title);
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
