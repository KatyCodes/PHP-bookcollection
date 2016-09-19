<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Book.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();
    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=book_collection';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('books' =>  Book::getAll()));
    });

    $app->post("/search", function() use ($app){
        return $app['twig']->render('search.html.twig', array('results' =>  Book::find($_POST['search']), 'search_title' => $_POST['search']));
    });

    $app->post("/add", function() use ($app){
        $book = new Book($id = 1, $_POST['title'], $_POST['author']);
        $book->save();
        return $app['twig']->render('add.html.twig', array('books' => $book));
    });

   $app->post("/delete", function() use ($app){
       Book::deleteAll();
       return $app['twig']->render('delete.html.twig');
   });

    return $app;
?>
