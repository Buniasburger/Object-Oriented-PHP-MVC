<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts()
    {
        $this->db->query('SELECT *, posts.id AS postId,
                                                     posts.created_at AS created,
                                                     users.id 
                                                     AS userId 
                                                     FROM posts 
                                                     INNER JOIN users
                                                     ON posts.user_id = users.id
                                                     ORDER BY posts.created_at DESC');
        return $this->db->resultSet();
    }

    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (title, user_id, body) VALUES (:title, :user_id, :body)');
        // Bind values
        $this->db->bind('title', $data['title']);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('body', $data['body']);

        return $this->db->execute();
    }
}