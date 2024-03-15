<?php

namespace Coderjerk\Scrapeheap;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use Parsedown;

class Document
{
    /**
     * Creates anf Formats an MS Word document.
     *
     * @param string $target_url
     * @param string $title
     * @param string $content
     * @return void
     */
    public static function make(string $target_url, string $title, string $content, bool $word_doc, bool $html, bool $markdown): void
    {
        $phpWordTemplate = new PhpWord;

        Settings::setOutputEscapingEnabled(true);

        $phpWordTemplate->addTitleStyle(
            1,
            ['bold' => true, 'size' => 32],
            ['spaceAfter' => 640]
        );

        // New portrait section
        $section = $phpWordTemplate->addSection();

        // Simple text
        $section->addTitle($title, 1);
        $section->addLink($target_url, $target_url);

        // Two text break
        $section->addTextBreak(2);

        $section->addText($content);

        $section->addTextBreak(4);

        // Link
        $section->addLink($target_url, 'View Page');
        $section->addTextBreak(2);

        $domain = parse_url($target_url, PHP_URL_HOST);

        // Format & shorten path title for doc files
        $pathTitle = self::formatTitle( $title);

        // Save files
        if ($word_doc) {
            $pathDocx = "output/Docx/{$domain}/";
            self::saveDocx($phpWordTemplate, $pathDocx, $pathTitle);
        }

        if ($html) {
            $pathHTML = "output/HTML/{$domain}/";
            self::saveHTML($phpWordTemplate, $pathHTML, $pathTitle);
        }

        if ($markdown) {
            $pathMarkdown = "output/Markdown/{$domain}/";
            self::saveMarkdown($content, $pathMarkdown, $pathTitle, $title);
        }

        // defaults to just save HTML file format if user doesnt choose any format
        if (!$word_doc && !$html && !$markdown) {
            $pathHTML = "output/HTML/{$domain}/";
            self::saveHTML($phpWordTemplate, $pathHTML, $pathTitle);
        }
    }

    /**
     * Saves into HTML Document
     *
     * @param  $phpWordTemplate
     * @param  $path
     * @param  $title
     * @return void
     */
    public static function saveHTML($phpWordTemplate, $path, $pathTitle)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $objWriter = IOFactory::createWriter($phpWordTemplate, 'HTML');
        $objWriter->save("{$path}{$pathTitle}.html");
    }

    /**
     * Saves as Word Doc
     *
     * @param  $phpWordTemplate
     * @param  $path
     * @param  $title
     * @return void
     */
    public static function saveDocx($phpWordTemplate, $path, $pathTitle)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $objWriter = IOFactory::createWriter($phpWordTemplate, 'Word2007');
        $objWriter->save("{$path}{$pathTitle}.docx");
    }

    /**
     * Saves as Markdown
     *
     * @param  $phpWordTemplate
     * @param  $path
     * @param  $title
     * @return void
     */
    public static function saveMarkdown($content, $path, $pathTitle, $title)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // formats doc with title
        $markdownContent = "# {$title}\n\n{$content}";

        file_put_contents("{$path}{$pathTitle}.md", $markdownContent);
    }

    /**
     * Formats and Shortens Title
     *
     * @param  string $title
     * @return string
     */
    public static function formatTitle($title)
    {
        $title = str_replace(' ', '_', $title);
        $title = str_replace('&', 'and', $title);
        $title = str_replace('|', '', $title);
        $title = str_replace('%', '_percent', $title);
        $title = str_replace('{', '_', $title);
        $title = str_replace('}', '_', $title);
        $title = str_replace("\\", '_', $title);
        $title = str_replace("<", '_', $title);
        $title = str_replace(">", '_', $title);
        $title = str_replace("*", '', $title);
        $title = str_replace("?", '', $title);
        $title = str_replace("/", '_', $title);
        $title = str_replace("$", '', $title);
        $title = str_replace("!", '', $title);
        $title = str_replace("'", '', $title);
        $title = str_replace('"', '', $title);
        $title = str_replace(":", '_', $title);
        $title = str_replace("@", '', $title);
        $title = str_replace("+", '', $title);
        $title = str_replace("`", '', $title);
        $title = str_replace("=", '_', $title);
        $title = str_replace(",", '_', $title);
        $title = str_replace("-", '_', $title);

        $title = strlen($title) > 80 ? substr($title, 0, 80) . '...' : $title;

        return $title;
    }
}
