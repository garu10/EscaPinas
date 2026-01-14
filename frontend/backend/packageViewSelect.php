<?php
include("php/connect.php");
$tour_id = isset($_GET['tour_id']) ? $_GET['tour_id'] : die("Tour ID not found.");

$tourQuery = "SELECT tp.*, d.destination_name, r.island_name 
                FROM tour_packages tp
                JOIN destinations d ON tp.destination_id = d.destination_id
                JOIN regions r ON d.island_id = r.island_id
                WHERE tp.tour_id = $tour_id";

$tourResult = executeQuery($tourQuery);
$tour = mysqli_fetch_assoc($tourResult);

$placesQuery = "SELECT * FROM tour_place WHERE tour_id = $tour_id";
$placesResult = executeQuery($placesQuery);

$itineraryQuery = "SELECT * FROM tour_itinerary WHERE tour_id = $tour_id ORDER BY day_number ASC, itinerary_id ASC";
$itineraryResult = executeQuery($itineraryQuery);

$itineraryData = [];
while ($row = mysqli_fetch_assoc($itineraryResult)) {
    $itineraryData[$row['day_number']][] = $row['short_desc'];
}

$aboutQuery = "SELECT * FROM tour_about WHERE tour_id = $tour_id";
$aboutResult = executeQuery($aboutQuery);
$about = mysqli_fetch_assoc($aboutResult);

$tour_id = isset($_GET['tour_id']) ? (int) $_GET['tour_id'] : 0;

$ratingQuery = "SELECT AVG(rating_score) as avg_rating, COUNT(review_id) as total_reviews 
                    FROM ratings 
                    WHERE tour_id = $tour_id";
$ratingResult = executeQuery($ratingQuery);
$ratingData = mysqli_fetch_assoc($ratingResult);

$average = $ratingData['avg_rating'] ? round($ratingData['avg_rating'], 1) : 0;
$count = $ratingData['total_reviews'] ?? 0;

$isLoggedIn = isset($_SESSION['user_id']);
$uid = $_SESSION['user_id'] ?? 0;
$isWishlisted = false;

if ($isLoggedIn) {
    $wishCheckQuery = "SELECT * FROM wishlist WHERE user_id = $uid AND tour_id = $tour_id";
    $wishCheckResult = executeQuery($wishCheckQuery);
    $isWishlisted = mysqli_num_rows($wishCheckResult) > 0;
}
{// Fetch all reviews for this specific tour
$reviewsQuery = "SELECT r.*, u.first_name, u.last_name 
                 FROM ratings r 
                 JOIN users u ON r.user_id = u.user_id 
                 WHERE r.tour_id = $tour_id 
                 ORDER BY r.review_id DESC";
$reviewsResult = executeQuery( $reviewsQuery);
}
?>