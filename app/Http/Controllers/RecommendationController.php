<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use db;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        global $db;

        $dbUser     = defined('DB_USER') ? DB_USER : 'root';
        $dbPassword = defined('DB_PASSWORD') ? DB_PASSWORD : '';
        $dbName     = defined('DB_NAME') ? DB_NAME : 'laravel_online_shopping';
        $dbHost     = defined('DB_HOST') ? DB_HOST : 'localhost';

        if (isset($db)) {
            return;
        }

        try {

            $db = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error:" . $exception->getMessage();
        }


        $statement = $db->prepare("SELECT ratings.id, ratings.user_id, ratings.rating, products.name
        from ratings
        inner join products on ratings.product_id = products.id
        ");

        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        $matrix = array();  // declaring an array called matrix


        foreach ($products as $product) {
            $statement = $db->prepare("SELECT first_name 
                from users
                where id='" . $product["user_id"] . "'");
            $statement->execute();
            $username = $statement->fetchAll(PDO::FETCH_ASSOC);

            $matrix[$username[0]['first_name']][$product['name']] = $product['rating'];
        }


        $statement = $db->prepare("SELECT first_name from users");
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);


        return view('dynamic_pages.recomendations.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * similarity_distance function
     *
     * @param  $matrix, $person1, $person2
     * @return \Illuminate\Http\Response
     */
    public function similarity_distance($matrix, $person1, $person2)
    {
        $similar = array();
        $sum = 0;
        if (!isset($matrix[$person1])) {
            return;
        }
        foreach ($matrix[$person1] as $key => $value) {
            if (array_key_exists($key, $matrix[$person2])) {
                $similar[$key] = 1;
            }
        }
        if ($similar == 0) {
            return 0;
        }

        foreach ($matrix[$person1] as $key => $value) {
            if (array_key_exists($key, $matrix[$person2])) {
                $sum = $sum + pow($value - $matrix[$person2][$key], 2);
            }
        }

        return 1 / (1 + sqrt($sum));
    }


    /**
     * getRecommendation function
     *
     * @param  $matrix, $person
     * @return \Illuminate\Http\Response
     */
    function getRecommendation($matrix, $person)
    {
        $total = array();
        $simsums = array();
        $ranks = array();

        foreach ($matrix as $otherPerson => $value) {
            if ($otherPerson != $person) {
                $sim = similarity_distance($matrix, $person, $otherPerson);
                if (!isset($matrix[$person])) {
                    continue;
                }
                foreach ($matrix[$otherPerson] as $key => $value) {

                    if (!array_key_exists($key, $matrix[$person])) {
                        if (!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }

                        $total[$key] += $matrix[$otherPerson][$key] * $sim;

                        if (!array_key_exists($key, $simsums)) {
                            $simsums[$key] = 0;
                        }

                        $simsums[$key] += $sim;
                    }
                }
            }
        }

        foreach ($total as $key => $value) {
            $ranks[$key] = $value / $simsums[$key];
        }
        array_multisort($ranks, SORT_DESC);
        return $ranks;
    }
}
