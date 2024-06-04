<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$start_year = $data['start_year'];
$end_year = $data['end_year'];

$articles = [
    // Mock data representing articles with their publication year
    ['title' => 'Article 1', 'year' => 2007],
    ['title' => 'Article 2', 'year' => 2008],
    ['title' => 'Article 3', 'year' => 2010],
    // Add more articles as needed
];

$filtered_articles = array_filter($articles, function($article) use ($start_year, $end_year) {
    return $article['year'] >= $start_year && $article['year'] <= $end_year;
});

$article_count = count($filtered_articles);
$page_count = ceil($article_count / 5); // Assuming 5 articles per page

echo json_encode([
    'article_count' => $article_count,
    'page_count' => $page_count
]);
?>
