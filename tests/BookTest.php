<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=book_collection_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
       {
         Book::deleteAll();
       }

        function test_getTitle()
        {
            //Arrange
             $id = 1;
             $title = "Great Gatsby";
             $author = "Fitz";
             $test_Book = new Book($id, $title, $author);

            //Act
            $result = $test_Book->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }

        function test_getAuthor()
        {
            //Arrange
             $id = 1;
             $title = "Great Gatsby";
             $author = "Fitz";
             $test_Book = new Book($id, $title, $author);

            //Act
            $result = $test_Book->getAuthor();

            //Assert
            $this->assertEquals($author, $result);
        }

        function test_getID()
        {
            //Arrange
             $id = 1;
             $title = "Great Gatsby";
             $author = "Fitz";
             $test_Book = new Book($id, $title, $author);

            //Act
            $result = $test_Book->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
             $id = 1;
             $title = "Great Gatsby";
             $author = "Fitz";
             $test_Book = new Book($id, $title, $author);
             $test_Book->save();

            //Act
            $result = Book::getAll();

            //Assert
            $this->assertEquals($test_Book, $result[0]);
        }
    }

?>
