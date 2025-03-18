<?php
include 'dbconnect.php'; // Include database connection

// Get Product ID from URL
if(isset($_GET['id']))
{
$product_id =  intval($_GET['id']);

// Fetch product details from database
$sql = "SELECT * FROM productdb WHERE id = $product_id";
$result = $conn->query($sql);

// Check if product exists
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Product not found.");
}
}
else
{
  die("Invalid product ID!");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Ayurvedic Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .jumbotron {
            background: url('<?php echo $product["image"]; ?>') center/cover no-repeat;
            color: white;
            padding: 80px 20px;
            text-align: center;
        }
        .product-img {
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }
        .section-title {
            border-bottom: 2px solid #28a745;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="logo.png" alt="Logo" height="50"></a>
            <a class="nav-link" href="ayurvedaplants.html">Back to Plants</a>
        </div>
    </nav>

    <div class="jumbotron">
        <h1><?php echo $product['name']; ?></h1>
        <p><?php echo $product['short_description']; ?></p>
    </div>

    <div class="container my-5">
        <div class="row">
        
        <div class="col-md-5">
    <img id="plant-image" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid product-img">
    <div class="text-center my-3">
    <h4 class="text-success">Price: ₹<?php echo number_format($product['price'], 2); ?></h4>
        <form action="buynow.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
            <button type="submit" class="btn btn-primary">Buy Now</button>
        </form>
    </div>
</div>
            <div class="col-md-7">
                <h3 class="section-title">Quick Overview</h3>
                <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
                <p><strong>Ingredients:</strong> <?php echo $product['ingredients']; ?></p>
                <p><strong>Weight:</strong> <?php echo $product['weight']; ?></p>
                
            </div>
        </div>

        <div class="my-5">
            <h3 class="section-title">💪 Health Benefits</h3>
            <p><?php echo nl2br($product['health_benefits']); ?></p>
        </div>

        <div class="my-5">
            <h3 class="section-title">🩺 Diseases & Conditions It Helps With</h3>
            <p><?php echo nl2br($product['diseases']); ?></p>
        </div>

        <div class="my-5">
            <h3 class="section-title">🍵 How to Use</h3>
            <p><?php echo nl2br($product['how_to_use']); ?></p>
        </div>

        <div class="my-5">
            <h3 class="section-title">⚠️ Precautions</h3>
            <p><?php echo nl2br($product['precautions']); ?></p>
        </div>

        <div class="text-center my-5">
            <a href="ayurvedaplants.html" class="btn btn-success">Back to Plants</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
