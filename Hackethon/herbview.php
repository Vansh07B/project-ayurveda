<?php
include("dbconnect.php");

// Get herb ID from URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Prevent SQL injection

    // Fetch herb details
    $sql = "SELECT * FROM herbdb WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $herb = $result->fetch_assoc();
    } else {
        echo "Herb not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $herb['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center"><?php echo $herb['name']; ?></h1>
        <img src="images/<?php echo $herb['image']; ?>" class="img-fluid mx-auto d-block" alt="<?php echo $herb['name']; ?>" style="max-width: 400px;">
        <p class="mt-3"><?php echo $herb['description']; ?></p>
        <a href="ayurvedaplants.html" class="btn btn-primary">Back to Plants</a>
    </div>
</body>
</html>
