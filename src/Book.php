<?php
    class Book
    {
        private $id;
        private $title;
        private $author;

        function __construct($id = null, $title, $author)
        {
            $this->id = $id;
            $this->title = $title;
            $this->author = $author;
        }
        function setTitle($book_title)
        {
            $this->title = (string) $book_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function getAuthor()
        {
            return $this->author;
        }

        function getId()
        {
            return $this->id;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books;");
        }

        static function getAll()
        {
            $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
            $books = array();
            foreach($returned_books as $book){
                $id = $book['id'];
                $title = $book['title'];
                $author = $book['author'];
                $new_book = new Book($id, $title, $author);
                array_push($books, $new_book);
            }
            return $books;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO books (title, author) VALUES ('{$this->getTitle()}', '{$this->getAuthor()}')");
            $this->id = $GLOBALS['DB']->lastInsertID();
        }

        static function find($search_title)
        {
            $found_book = "";
            $books = Book::getAll();
            foreach($books as $book) {
                $book_title= $book->getTitle();
                if (strtolower($book_title) == strtolower($search_title)) {
                $found_book = $book;
            }
        }
        return $found_book;
        }
    }

?>
