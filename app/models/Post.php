<?php

class Post {



    public static function getPosts(){
        $dbh = App::get('dbh');
        $statement = $dbh->prepare("SELECT * FROM posts");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Post');

    }

    public static  function addPost() {
        $dbh = App::get('dbh');
        $statement = $dbh->prepare('INSERT INTO posts (title, user_id, content) VALUES(:title, :user_id, :content)');

        // Bind values
        $data=[];
        $statement->dbh->bind(':title', $data['title']);
        $statement->dbh->bind(':user_id', $data['user_id']);
        $statement->dbh->bind(':content', $data['content']);

        if($statement->dbh->execute()){
            return true;
        } else {
            return false;
        }

    }



}
