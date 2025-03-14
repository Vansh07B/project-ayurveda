<?php
include("dbconnect.php");

// Get product ID from URL
if (isset($_GET['id'])) 
{
    $product_id = intval($_GET['id']);

    // Fetch product details from database
    $sql = "SELECT * FROM productdb WHERE id = $product_id";
    $result = $conn->query($sql); //mysqli_query($conn,$sql);

    if ($result->num_rows > 0) 
    {
        $product = $result->fetch_assoc();
    } 
    else 
    {
        die("Product not found!");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="ayurveda_products.html">Ayurveda Store</a>
    </div>
</nav>

<!-- Product Details Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $product['image']; ?>" class="img-fluid" alt="<?php echo $product['name']; ?>">
        </div>
        <div class="col-md-6">
            <h2><?php echo $product['name']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <h4 class="text-success">Price: ₹<?php echo $product['price']; ?></h4>
            <button class="btn btn-primary">Buy Now</button>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
