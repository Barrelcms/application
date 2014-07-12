<?php

use Barrel\Markdown\Parsedown\ParsedownMarkdown;

class ParsedownMarkdownTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->parsedown = new ParsedownMarkdown;

        $this->markdownFile = $this->storage.'Markdown/Parsedown/TestMarkdown.md';
    }

    public function tearDown()
    {
        unset($this->parsedown);
        unset($this->markdownFile);
    }

    public function testIsInstanceOfMarkdownInterface()
    {
        $this->assertInstanceOf('Barrel\Markdown\MarkdownInterface', $this->parsedown);
    }

    public function testBasicMarkdownConversionUsingString()
    {
        $string = 'Hello World.';
        $expected = '<p>Hello World.</p>';
        $actual = $this->parsedown->convertString($string);

        $this->assertEquals($expected, $actual);
    }

    public function testBasicMarkdownConversionUsingFile()
    {
        $expected = '<p>Hello World.</p>';
        $actual = $this->parsedown->convertFile($this->markdownFile);

        $this->assertEquals($expected, $actual);
    }

}