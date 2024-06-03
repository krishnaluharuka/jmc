<?php
require 'includes/connect.php';

// Define how many results you want per page
$results_per_page = 6;

// Find out the number of results stored in the database
$result = $con->query('SELECT COUNT(*) AS total FROM products');
$row = $result->fetch_assoc();
$number_of_results = $row['total'];

// Determine number of total pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page > $number_of_pages) $page = $number_of_pages;
if ($page < 1) $page = 1;

// Determine the starting limit number for the results on the displaying page
$start_limit = ($page - 1) * $results_per_page;

// Retrieve the selected results from the database
$stmt = $con->prepare('SELECT * FROM products LIMIT ?, ?');
$stmt->bind_param('ii', $start_limit, $results_per_page);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagination Example</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="home.php?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $number_of_pages; $i++): ?>
                <a href="home.php?page=<?php echo $i; ?>"<?php if ($page == $i) echo ' class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $number_of_pages): ?>
                <a href="home.php?page=<?php echo $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
