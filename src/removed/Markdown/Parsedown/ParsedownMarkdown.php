<?php namespace Barrel\Markdown\Parsedown;

use Barrel\Markdown\MarkdownInterface;
use ParsedownExtra;

/**
 * Wrap an instance of parsedown extra to be used with the
 * application easily.
 */
class ParsedownMarkdown implements MarkdownInterface {

    /**
     * An instance of the ParsedownExtra class.
     *
     * @var ParsedownExtra
     */
    private $processor;

    /**
     * Construct the class with an instance of ParsedownExtra.
     */
    public function __construct()
    {
        $this->processor = new ParsedownExtra;
    }

    /**
     * Convert a given markdown string into html.
     *
     * @param  string $string   The markdown string to convert.
     * @return string           The converted markdown in HTML.
     */
    public function convertString($string)
    {
        return $this->processor->text($string);
    }

    /**
     * Convert a given markdown file to html.
     *
     * @param  string $path The path to the file to convert.
     * @return string       The converted markdown in HTML.
     */
    public function convertFile($path)
    {
        $string = file_get_contents($path);

        return $this->processor->text($string);
    }

}