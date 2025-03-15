<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayurvedic Articles</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/articles.css">
    
    <style>
        /* Banner Styling */
        .banner {
            position: relative;
            background: url('images/articlebg.jpeg') no-repeat center center/cover;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .banner .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay for readability */
        }

        .banner-content {
            position: relative;
            z-index: 2;
        }

        .banner h1 {
            font-size: 2.8rem;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .banner p {
            font-size: 1.2rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>

    <!-- Banner Section -->
    <header class="banner">
        <div class="overlay"></div>
        <div class="banner-content">
            <h1>Ayurvedic Articles & Knowledge Hub</h1>
            <p>Explore insights on Ayurveda, herbs, and wellness.</p>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container my-5">
        <div class="row">
            
            <!-- Sidebar -->
            <aside class="col-md-3">
                <h4 class="section-title">Categories</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#" class="filter-btn" data-category="all">All Articles</a></li>
                    <li class="list-group-item"><a href="#" class="filter-btn" data-category="Ayurveda Basics">Ayurveda Basics</a></li>
                    <li class="list-group-item"><a href="#" class="filter-btn" data-category="Ayurveda History">Ayurveda History</a></li>
                    <li class="list-group-item"><a href="#" class="filter-btn" data-category="Scientific Research">Scientific Research</a></li>
                    <li class="list-group-item"><a href="#" class="filter-btn" data-category="Health Risks">Health Risks</a></li>
                </ul>
            </aside>

            <!-- Articles Grid -->
            <section class="col-md-9">
                <div class="row" id="articles-container">
                    
                    <?php
                    include("dbconnect.php");
                    $sql = "SELECT id, title, description, category, date_published FROM articledb ORDER BY date_published DESC";
                    $result = $conn->query($sql);

                    while ($article = $result->fetch_assoc()) { ?>
                        <div class="col-md-4 mb-4 article-card" data-category="<?php echo htmlspecialchars($article['category']); ?>">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title text-success fw-bold text-center">
                                        <?php echo htmlspecialchars($article['title']); ?>
                                    </h5>
                                    <p class="card-text text-muted text-center">
                                        <small><strong>Published:</strong> <?php echo htmlspecialchars($article['date_published']); ?></small>
                                    </p>
                                    <p class="card-text">
                                        <?php echo substr(htmlspecialchars($article['description']), 0, 100); ?>...
                                    </p>
                                    <div class="text-center">
                                        <a href="articleview.php?id=<?php echo $article['id']; ?>" class="btn btn-sm btn-outline-success">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center p-3 bg-light">
        <p>© 2025 Ayurvedic Knowledge Hub | All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const articles = document.querySelectorAll('.article-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const category = this.dataset.category;

                    articles.forEach(article => {
                        if (category === 'all' || article.dataset.category === category) {
                            article.style.display = 'block';
                        } else {
                            article.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

</body>
</html>
<?php $conn->close(); ?>
