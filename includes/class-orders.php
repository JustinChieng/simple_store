<?php

class Orders 
{
    public $database;

    public function __construct()
    {
        try
        {
            $this->database = connectToDB();
        } catch (PDOException $error ) {
            die ("Database connection failed");
        }
    }

    public function createNewOrder (
    $user_id, //find tout who make the order
    $total_amount = 0, //find out what's the total amount
    $products_in_cart =[] // get thte products in the order
    )
    {
        //step #1 insert a new order into database
        $statement = $this->database->prepare(
            'INSERT INTO orders (user_id, total_amount, transaction_id)
            VALUES (:user_id, :total_amount, :transaction_id)'
        );

        $statement->execute([
            'user_id' => $user_id,
            'total_amount' => $total_amount,
            'transaction_id' => ''
        ]);

        //step 2: retrieve order id using lastInsertId()
        //lastInserId() allows us to retrieve the id of the new order we just added above

         $order_id = $this->database->lastInsertId();


        //step 3: create order_products bridge
        foreach( $products_in_cart as $product_id => $quantity ) 
        {
        // insert each product in cart as new row in the orders_products table   
            $statement = $this->database->prepare (
                'INSERT INTO orders_products (order_id, product_id, quantity)
                VALUES (:order_id, :product_id, :quantity)'
            );

            $statement->execute([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);


        }

    }

    public function listOrders( $user_id )
    {
        // retrieve the orders data from database based on the given user_id
        $statement = $this->database->prepare('SELECT * FROM orders WHERE user_id = :user_id');
        $statement->execute([
            'user_id' => $user_id
        ]);

         // fetch all the orders data 
         return $statement->fetchAll(PDO::FETCH_ASSOC); 
    }

    //list out all the products in side a single order

    public function listProductsinOrder($order_id)
    {
        //retrieve products data using JOIN
        $statement = $this->database->prepare(
        'SELECT
        products.id,
        products.name, 
        orders_products.order_id,
        orders_products.quantity
        FROM orders_products
        JOIN products
        ON orders_products.product_id = products.id
        WHERE order_id = :order_id'
        );

        $statement->execute([
            'order_id' => $order_id
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
