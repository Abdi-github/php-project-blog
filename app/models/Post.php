<?php

class Post {

    private $id;
    private $user_id;
    private $title;
    private $content;
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
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
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public static function fetchById($id)
    {
        // ASSUMPTION
        //    - $id was validated by the caller

        $dbh = App::get('dbh');

        // prepared statement with named placeholders
        $statement = $dbh->prepare("SELECT * FROM posts WHERE id = ?");
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Post');
        $statement->execute([$id]);
        return $statement->fetch();
    }






    public static function getPosts(){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("SELECT * FROM posts");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Post');

    }

    public static function addPost($title, $content){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("insert into posts ( title, content) VALUES (:title, :content)");
        $statement->execute([
            'title'   => $title,
            'content'    => $content]);
    }




    public function asHTML() {
        $str = "";

        $str .= "<div class=\"card card-body mb-3\">\n";

        $str .= "<h4 class=\"card-title\">\n";
        $str .= htmlentities($this->title);
        $str .= "</h4>";

        $str .= "<div class=\"bg-light p-2 mb-3\">";
        $str .= "Written By: ";
        $str .= urlencode($this->user_id) . 'on ' . htmlentities($this->created_at) ;

        $str .= "</div>";

        $str .= "<p class=\"card-text\">";
        $str .= htmlentities($this->content);
        $str .= "</p>";

        $str .= "<span class=\"btn btn-dark\">";
        $str .= "<a href=\"/php_project/post?id=" . urlencode($this->id) . "\"> More </a>";
        $str .= "</span>";


        $str .= "</div>\n";




        return $str;




    }
















}
