<?php 

session_start();

require "includes/functions.php";
require "includes/class-products.php";

//call the products class
$products = new Products();

//vardump the products
$products_list = $products->listAllProducts();

    var_dump( $products_list[0]['name'] );
    // var_dump( $products_list[0]->name );

$database = connectToDB();

var_dump (isLoggedIn());  

//require the header part
require "parts/header.php";
?>

  <body>
    <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
      <div class="min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="h1">My Store</h1>
          <div class="d-flex align-items-center justify-content-end gap-3">
            <a href="/cart" class="btn btn-success">My Cart</a>
          </div>
        </div>

        <!-- products -->
        <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php foreach ($products_list as $product) :?>
          <div class="col">
            <div class="card h-100">
              <img
                src="<?php echo $product['image_url']; ?>"
                class="card-img-top"
                alt="Product 1"
              />
              <div class="card-body text-center">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="card-text"><?php echo $product['price']; ?></p>
                <!-- when button is clicked the user will go to the cart page -->
                <form 
                method="POST"
                action="/cart"
                >
                <input type="hidden"
                name="product_id"
                value="<?php echo $product['id'];?>"
                >
                <button class="btn btn-primary">Add to cart</button>


                </form>
              </div>
            </div>
          </div>
          
          <?php endforeach; ?>
        </div>
      </div>

      <!-- footer -->

      <?php 
require "parts/footer.php";
?>
