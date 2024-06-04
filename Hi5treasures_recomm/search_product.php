<?php
include('includes/connect.php');
include('navbar.php');

            
            if (isset($_GET['search_data_product'])) {
            
                // Sanitize the input
                $search = test($_GET['search_data']);
            
                // Check for script tags after sanitization
                // if (preg_match('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', $search)) {
                //     die('Invalid input. Scripts are not allowed.');
                // }
                
                // Proceed with search functionality
                // echo "Search term: " . $search;
                
            }
            function test($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            search_product();
            
            
            ?>