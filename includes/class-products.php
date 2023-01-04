<?php 

class Products
{
    public $database;
    public function __construct()
    {
        try{
        // we will try to establish the database connection
        $this->database = connectToDB();
        } catch ( PDOException $error ){
            echo "Database connection failed" . $error->getMessage();
        }
    }

    /**
     * retrieve aall products from database
     */
    public function listAllProducts()
     {
        // $products = [];
        // //prepare the database, execute and fetch all
        // $statement = $this->database->prepare('SELECT * FROM products');
        // //execute
        // $statement->execute();
        // //fetchAll
        // $products = $statement->fetchAll();

        // return $products;

         // prepare the database
        $statement = $this->database->prepare('SELECT * FROM products');
        // execute
        $statement->execute();
        // fetchAll
        return $statement->fetchAll(PDO::FETCH_ASSOC);
        /*
            fetch all data from database
            use PDO::FETCH_OBJ if you want array ->name
            use PDO::FETCH_ASSOC if you want object ['name']
        */
     }

     /**
     * Find product by id
     */
    public function findProduct( $product_id )
    {
       
        //find the product based on product_id
            $statement = $this->database->prepare(" SELECT * FROM products WHERE id = :id");
            $statement -> execute([
                'id' => $product_id
            ]);
        //retrieve the product
        return $statement->fetch(PDO::FETCH_ASSOC);
    }



}