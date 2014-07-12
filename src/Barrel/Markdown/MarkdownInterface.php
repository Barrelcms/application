<?php namespace Barrel\Markdown;

interface MarkdownInterface {
    public function convertString($string);
    public function convertFile($path);
}