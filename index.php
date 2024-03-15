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
    <form action="action.php" method="post">
        <label for="target_url">Target URL</label>
        <input type="url" name="target_url" id="target_url">
        <br>
        <br>
        <p>
            Choose a format for your scraped content. <br>
            Otherwise they will be thrown back to you as HTML files.
        </p>
        <input type="checkbox" name="word_doc" id="word_doc" value="word_doc">
        <label for="word_doc">Word Doc</label>
        <br>
        <br>
        <input type="checkbox" name="html" id="html" value="html">
        <label for="html">HTML</label>
        <br>
        <br>
        <input type="checkbox" name="markdown" id="markdown" value="markdown">
        <label for="markdown">Markdown</label>
        <br>
        <br>
        <input type="submit" value="Scrape" class="button" id="submitBtn">
    </form>
</body>

<script src="script.js"></Script>

</html>
