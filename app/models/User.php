<?php

class User
{
    private $id;
    private $user_name;
    private $email;
    private $password;
    private $created_at;

    // Getters and Setters

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserName($value)
    {
        $this->user_name = $value;
    }

    /**
     * @param mixed $title
     */
    public function setEmail($value)
    {
        $this->email = $value;
    }

    /**
     * @param mixed $content
     */
    public function setPassword($value)
    {
        $this->password = $value;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($value)
    {
        $this->created_at = $value;
    }

    public static function fetchByEmail($email)
    {
        // ASSUMPTION
        //    - $id was validated by the caller

        $dbh = App::get('dbh');

        // prepared statement with named placeholders
        $statement = $dbh->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        return $statement->fetch();
        $statement->rowCount();

        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    // Get User by ID
    public function getUserById($id)
    {
        $dbh = App::get('dbh');
        $statement = $dbh->prepare('SELECT * FROM users WHERE id = :id');
        // Bind value
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch();

    }

    public static function getUsers()
    {
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("SELECT * FROM users");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'User');

    }

    public static function register($data)
    {

        $dbh = App::get('dbh');
        $statement = $dbh->prepare("INSERT INTO users (user_name, email, password) VALUES (:user_name, :email, :password)");
        $statement->bindParam(':user_name', $data['user_name'], PDO::PARAM_STR);
        $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $statement->bindParam(':password', $data['password'], PDO::PARAM_STR);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public static function login($email, $password)
    {
        $dbh = App::get('dbh');

        $statement = $dbh->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_OBJ);

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }

    }

}
