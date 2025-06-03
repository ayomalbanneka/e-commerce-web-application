<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanElegance - Stay Elegant, Stay Urban</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.0/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />

</head>

<body>

    <?php include "header.php"; ?>

    <div id="basicSearchResult" class="anime2">

        <div id="sortResult"></div>

    </div>

    <script>
        // 1. This waits until the page is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // 2. Get saved information from browser memory
    const searchResults = sessionStorage.getItem('searchResults'); // The search results
    const searchQuery = sessionStorage.getItem('searchQuery'); // What you searched for
    const currentPage = sessionStorage.getItem('currentPage') || 1; // Which page you're on
    
    // 3. Show the results if they exist
    if (searchResults) {
        // Put the results in the results area
        document.getElementById('basicSearchResult').innerHTML = searchResults;
        
        // 4. Make all the page number links work properly
        document.querySelectorAll('.pagination a').forEach(link => {
            const href = link.getAttribute('href') || '';
            if (href.includes('page=')) {
                // Update the page number in the link
                const newHref = href.replace(/(page=)\d+/, `$1${currentPage}`);
                link.setAttribute('href', newHref);
                // Make sure clicking the link calls the search function
                link.setAttribute('onclick', `basicSearch(${currentPage}, event)`);
            }
        });
    } else {
        // 5. If no results found, show a message
        document.getElementById('basicSearchResult').innerHTML = 'No Results Found';
    }
    
    // 6. Put the search term back in the search box
    if (searchQuery) {
        document.getElementById('basic_search_txt').value = searchQuery;
    }
});
    </script>

    <!-- footer  -->

    <?php include "footer.php"; ?>

    <!-- footer -->

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>