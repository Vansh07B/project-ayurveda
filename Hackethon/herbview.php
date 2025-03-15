<?php
include("dbconnect.php");

// Get herb ID from URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Prevent SQL injection

    // Fetch herb details
    $sql = "SELECT * FROM herbdb WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $herb = $result->fetch_assoc();
    } else {
        echo "<h2 class='text-center text-danger'>Herb not found!</h2>";
        exit();
    }
} else {
    echo "<h2 class='text-center text-danger'>Invalid request!</h2>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($herb['name']); ?> - Ayurvedic Herb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .jumbotron {
            background: url('<?php echo htmlspecialchars($herb["image"]); ?>') center/cover no-repeat;
            color: white;
            padding: 80px 20px;
            text-align: center;
            background-blend-mode: overlay;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .product-img {
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            width: 100%;
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="logo.png" alt="Logo" height="50"></a>
            <a class="nav-link" href="ayurvedaplants.html">Back to Plants</a>
        </div>
    </nav>

    <!-- Header -->
    <div class="jumbotron">
        <h1><?php echo htmlspecialchars($herb['name']); ?></h1>
        <p><?php echo htmlspecialchars($herb['category']); ?></p>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-5">
                <img src="<?php echo htmlspecialchars($herb['image']); ?>" alt="<?php echo htmlspecialchars($herb['name']); ?>" class="img-fluid product-img">
                
                <!-- Buy Now Button with Price -->
                <div class="text-center my-3">
                    <h4 class="text-success">Price: ₹<?php echo number_format($herb['price'], 2); ?></h4>
                    <form action="buynow.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $herb['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $herb['name']; ?>">
                        <input type="hidden" name="category" value="<?php echo $herb['category']; ?>">
                        <input type="hidden" name="image" value="<?php echo $herb['image']; ?>">
                        <input type="hidden" name="price" value="<?php echo $herb['price']; ?>">
                        <button type="submit" class="btn btn-primary">Buy Now</button>
                    </form>
                </div>
            </div>

            <div class="col-md-7">
                <h3 class="section-title">Quick Overview</h3>
                <p><strong>Scientific Name:</strong> <?php echo htmlspecialchars($herb['scientific_name']); ?></p>
                <p><strong>Common Names:</strong> <?php echo htmlspecialchars($herb['common_names']); ?></p>
                <p><strong>Found In:</strong> <?php echo htmlspecialchars($herb['found_in']); ?></p>
                <p><strong>Used Parts:</strong> <?php echo htmlspecialchars($herb['used_parts']); ?></p>
            </div>
        </div>

        <div class="my-5">
            <h3 class="section-title">🌿 History & Traditional Use</h3>
            <p><?php echo nl2br(htmlspecialchars($herb['history'])); ?></p>
        </div>

        <div class="my-5">
            <h3 class="section-title">💪 Health Benefits</h3>
            <ul>
                <?php 
                $benefits = explode(",", $herb['health_benefits']);
                foreach ($benefits as $benefit) {
                    echo "<li>" . htmlspecialchars(trim($benefit)) . "</li>";
                }
                ?>
            </ul>
        </div>

        <div class="my-5">
            <h3 class="section-title">🩺 Diseases & Conditions It Helps With</h3>
            <ul>
                <?php 
                $diseases = explode(",", $herb['diseases']);
                foreach ($diseases as $disease) {
                    echo "<li>" . htmlspecialchars(trim($disease)) . "</li>";
                }
                ?>
            </ul>
        </div>

        <div class="my-5">
            <h3 class="section-title">🍵 How to Use & Recipes</h3>
            <p><?php echo nl2br(htmlspecialchars($herb['usage_recipes'])); ?></p>
        </div>

        <div class="my-5">
            <h3 class="section-title">⚠️ Side Effects & Precautions</h3>
            <ul>
                <?php 
                $side_effects = explode(",", $herb['side_effects']);
                foreach ($side_effects as $effect) {
                    echo "<li>" . htmlspecialchars(trim($effect)) . "</li>";
                }
                ?>
            </ul>
        </div>

        <div class="text-center my-5">
            <a href="ayurvedaplants.html" class="btn btn-success">Back to Plants</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
