<?php

namespace Coderjerk\Scrapeheap;

use Coderjerk\Scrapeheap\Spider;
use RoachPHP\Roach;
use RoachPHP\Spider\Configuration\Overrides;


class Scrapeheap
{

    /**
     * Let's scrape.
     *
     * @param string $target_url
     * @return void
     */

     public function scrape(string $target_url, bool $word_doc, bool $html, bool $markdown): void
    {
        $base_domain = parse_url($target_url, PHP_URL_HOST);

        try {
            Roach::startSpider(
                Spider::class,
                new Overrides(startUrls: [$target_url]),
                context: [
                                    'base_domain' => $base_domain,
                                    'word_doc' => $word_doc,
                                    'html' => $html,
                                    'markdown' => $markdown,
                                    ],
            );
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        echo '<h3>All Done!</h3>';
        echo 'You scraped: ' . $target_url . '<br><br>';
        echo '
        <form action="action.php" method="post">
            <label for="target_url">Scrape again - Target URL</label>
            <input type="url" name="target_url" id="target_url">
            <br>
            <br>
            <p>
                Choose a file type for your scraped content. <br>
                Otherwise you will get them as HTML files.
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
        </form>';
    }
}
