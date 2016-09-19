<?php
    class Book
    {
        private $id;
        private $title;
        private $author;

        function __construct($id, $title, $author)
        {
            $this->id = $id;
            $this->title = $title;
            $this->author = $author;
        } 

    }

?>
