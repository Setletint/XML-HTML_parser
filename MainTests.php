<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require './main.php';

final class MainTests extends TestCase
{
    public function testCustomSplit() {
        $input = "<html><body>Hello</body></html>";
        $expected = ["<html>", "<body>", "Hello", "</body>", "</html>"];
        $this->assertEquals($expected, custom_split($input));
    }
    public function testFormatHTML()
    {
        $input = "<html><body><h1>Title</h1><p>testTxtP</p></body></html>";
        $expectedOutput = "<html>\n  <body>\n    <h1>Title</h1>\n    <p>testTxtP</p>\n  </body>\n</html>\n";
        $this->assertEquals($expectedOutput,format_XML_HTML($input));
    }


}