<?php

use Coderjerk\Scrapeheap\Scrapeheap;

require_once('bootstrap.php');

$target_url = $_POST['target_url'];

$word_doc = isset($_POST['word_doc']);
$html = isset($_POST['html']);
$markdown = isset($_POST['markdown']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrapedeep | Child of Scrapeheap</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Scrapedeep</h1>
    <?php (new Scrapeheap)->scrape($target_url, $word_doc, $html, $markdown); ?>
</body>

</html