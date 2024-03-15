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
    public static function make(string $target_url, string $title, string $content): void
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

        // Shorten path title for doc files
        $pathTitle = strlen($title) > 80 ? substr($title, 0, 80) . '...' : $title;

        // Save files
        $pathDocx = "output/Docx/{$domain}/";
        self::saveDocx($phpWordTemplate, $pathDocx, $pathTitle);

        $pathHTML = "output/HTML/{$domain}/";
        self::saveHTML($phpWordTemplate, $pathHTML, $pathTitle);

        $pathMarkdown = "output/Markdown/{$domain}/";
        self::saveMarkdown($content, $pathMarkdown, $pathTitle);
    }

    /**
     * Saves into HTML Document
     *
     * @param  $phpWordTemplate
     * @param  $path
     * @param  $title
     * @return void
     */
    public static function saveHTML($phpWordTemplate, $path, $title)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $objWriter = IOFactory::createWriter($phpWordTemplate, 'HTML');
        $objWriter->save("{$path}{$title}.html");
    }

    /**
     * Saves as Word Doc
     *
     * @param  $phpWordTemplate
     * @param  $path
     * @param  $title
     * @return void
     */
    public static function saveDocx($phpWordTemplate, $path, $title)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $objWriter = IOFactory::createWriter($phpWordTemplate, 'Word2007');
        $objWriter->save("{$path}{$title}.docx");
    }

    /**
     * Saves as Markdown
     *
     * @param  $phpWordTemplate
     * @param  $path
     * @param  $title
     * @return void
     */
    public static function saveMarkdown($content, $path, $title)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $markdownContent = new Parsedown();

        $markdownContent::instance()
            ->setBreaksEnabled(true)
            ->text($title)
            ->text("\n \n")
            ->text($content);

        // concatenate doc title to content
        $markdownContent = "# {$title}\n\n{$content}";

        file_put_contents("{$path}{$title}.md", $markdownContent);
    }
}
