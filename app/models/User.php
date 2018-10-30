<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('select * from users where email = :email');
        $this->db->bind('email', $email);
        $this->db->single();

        // Check row
        return $this->db->rowCount() > 0;
    }

    public function register($data)
    {
        $this->db->query('insert into users (name, email, password) values (:name, :email, :password)');
        // Bind values
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);

        return $this->db->execute();
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('select * from users where email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if(!password_verify($password, $row->password)) {
            return false;
        }

        return $row;
    }

    // Get user by id
    public function find($id)
    {
        $this->db->query('select * from users where id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}