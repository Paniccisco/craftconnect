<?php 
session_start();

include "db_conn.php";
include 'php/Seller.php';
$user = isset($_SESSION['seller_id']) && isset($_SESSION['fname']) ? getUserById($_SESSION['seller_id'], $conn) : null;
$users = isset($_SESSION['user_id']) && isset($_SESSION['fname']) ? getUserById($_SESSION['user_id'], $conn) : null;

try {
    $pdo = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    if(isset($_GET['seller_id'])) {
        $seller_id = $_GET['seller_id'];
        $stmt = $pdo->prepare("SELECT * FROM products where seller_id = ?");
        $stmt->execute([$seller_id]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    if(isset($_GET['seller_id'])) {
        $seller_id = $_GET['seller_id'];
        $stmt = $pdo->prepare("SELECT * FROM sellers WHERE seller_id = ?");
        $stmt->execute([$seller_id]);
        $seller = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($seller) {
            $styles = "background-color: " . $seller['bg_color'] . "; font-family: " . $seller['font_family'] . "; color: " . $seller['text_color'] . ";";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CraftConnect | <?= $seller['businessname'] ?></title>

     <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    .product-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }
    .product {
      width: 250px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .product img {
      width: 100%;
      border-radius: 5px;
    }
    .product-name {
      margin-top: 10px;
      font-weight: bold;
    }
    .product-price {
      margin-top: 5px;
      color: #888;
    }
    .color-selector {
      margin-top: 10px;
    }
    .color-option {
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      margin: 0 5px;
      cursor: pointer;
      transition: transform 0.3s ease-in-out; 
    }
    .color-option.selected {
      transform: scale(2.1); 
    }
    .add-to-cart {
      background-color: #2d35ee;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }
    .cart {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 10px;
    }
    .cart-icon {
      font-size: 24px;
      cursor: pointer;
      position: relative;
    }
    .cart-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: #ee4d2d;
      color: white;
      border-radius: 50%;
      padding: 5px;
      font-size: 12px;
    }
    .cart-items {
      list-style: none;
      padding: 0;
      max-height: 200px;
      overflow-y: auto;
    }
    .cart-item {
      margin-bottom: 5px;
    }
    /* .quantity-selector {
        position: absolute;
        top: 54%;
        left: 47%;
    } */
    .quantity-selector {
    text-align:right;   
    }
    .quantity {
        width: 15%;
        text-align: center;
    }
    .fixed-size-img {
        width: 200px;
        height: 200px;
    }

    .product-image-container {
    position: relative;
    }

    .available-icon {
    position: absolute;
    top: 0;
    right: 0;
    background-color: green;
    color: white;
    padding: 5px 10px;
    border-radius: 50%;
    font-size: 14px;
    font-weight: bold;
    }
    .product.disabled {
    opacity: 0.5;
    }

    .available-icon.zero-quantity {
    background-color: red;
    }

    
    h1 {
            margin-bottom: 20px;
            text-align: center;
        }
  </style>
</head>
<body style="<?= $styles ?>">
  <div class="container">
  <h1>Welcome to <?= $seller['businessname'] ?></h1>
    <div class="product-container">
    <a href="usermessage.php?seller_id=<?= $seller['seller_id'] ?>">Chat with Seller</a>
            <?php foreach ($products as $product) {
            $is_disabled = $product['product_qty'] == 0 ? 'disabled' : '';
        ?>
        <div class="product <?php echo $is_disabled; ?>" data-product-name="<?php echo $product['productname']; ?>">
            <div class="product-name"><?php echo $product['productname']; ?></div>
            <div class="product-image-container">
            <img src="uploads/<?php echo $product['image_filename']; ?>" alt="<?php echo $product['productname']; ?>" class="fixed-size-img">
            <?php if ($product['product_qty'] == 0) { ?>
                <div class="available-icon zero-quantity">0</div>
            <?php } else { ?>
                <div class="available-icon"><?php echo $product['product_qty']; ?></div>
            <?php } ?>
            </div>
            <div class="quantity-selector">
            <button class="decrement">-</button>
            <input type="number" class="quantity" value="1" min="1">
            <button class="increment">+</button>
            </div>
            <div class="product-price">₱<?php echo $product['productprice']; ?></div>
            <div class="color-selector">
            <?php 
            try {
                $stmt = $pdo->prepare("SELECT variant_name FROM testing_approve.products INNER JOIN testing_approve.product_variants ON products.product_id=product_variants.product_id where products.product_id = ?");
                $stmt->execute([$product['product_id']]);
                $product_variants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
            <?php foreach ($product_variants as $product_color) { ?>
                <div class="color-option" style="background-color: <?php echo $product_color['variant_name']; ?>; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);"></div>
            <?php } ?>
            </div>
            <button class="add-to-cart" data-price="<?php echo $product['productprice']; ?>">Add to Cart</button>
        </div>
        <?php } ?>

    </div>

    <div class="cart">
        <span class="cart-icon">&#128722;<span class="cart-count">0</span></span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
        <?php if(isset($_SESSION['user_id'])){ ?>
            <a class="add-to-cart" href="userhome.php" class="link-secondary">Home</a>
        <?php } else { ?>
            <a class="add-to-cart" href="sellerhome.php" class="link-secondary">Home</a>
        <?php } ?>

        <h2>Shopping Cart</h2>
        <ul class="cart-items"></ul>
    </div>  

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const addToCartButtons = document.querySelectorAll('.add-to-cart');
      const cartItemsList = document.querySelector('.cart-items');
      const cartCount = document.querySelector('.cart-count');
      const colorOptions = document.querySelectorAll('.color-option');
      
      let itemCount = 0;
      let selectedColors = {}; 

      addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
          const productName = this.parentNode.dataset.productName; 
          const productPrice = this.getAttribute('data-price');
          const selectedColor = selectedColors[productName] || 'No Color Selected'; 
          const quantity = parseInt(this.parentNode.querySelector('.quantity').value); 
          const cartItem = document.createElement('li');
          const totalPrice = (parseFloat(productPrice) * quantity).toFixed(2);
          
          cartItem.textContent = `${productName} - $${totalPrice} - Color: ${selectedColor} - Quantity: ${quantity}`; 
          cartItemsList.appendChild(cartItem);
          itemCount += quantity; 
          cartCount.textContent = itemCount;
        });
      });

      document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function() {
          const quantityInput = this.parentNode.querySelector('.quantity');
          quantityInput.value = parseInt(quantityInput.value) + 1;
        });
      });

      document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function() {
          const quantityInput = this.parentNode.querySelector('.quantity');
          if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
          }
        });
      });

      colorOptions.forEach(option => {
        option.addEventListener('click', function(event) {
          event.stopPropagation(); 
          const productName = this.closest('.product').dataset.productName; 
          const selectedColor = this.style.backgroundColor;
          selectedColors[productName] = selectedColor; 
          console.log('Selected color for', productName, ':', selectedColor);
          
          colorOptions.forEach(option => {
            option.classList.remove('selected');
          });
          
          this.classList.add('selected');
        });
      });

      document.body.addEventListener('click', function() {
        colorOptions.forEach(option => {
          option.classList.remove('selected');
        });
      });
    });
  </script>
</body>
</html>
<?php
        } else {
            echo "Seller not found.";
        }
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>  