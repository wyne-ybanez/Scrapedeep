<?php

use Coderjerk\Scrapeheap\Scrapeheap;

require_once('bootstrap.php');

$target_url = $_POST['target_url'];

$word_doc = isset($_POST['word_doc']);
$html = isset($_POST['html']);
$markdown = isset($_POST['markdown']);

(new Scrapeheap)->scrape($target_url, $word_doc, $html, $markdown);