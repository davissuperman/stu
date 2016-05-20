<?php
use Symfony\Component\DomCrawler\Crawler;
require 'Bootstrap.php';
$html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!</p>
        <div id="product">
            <a data-type="bla">
                <img src="OK">
            </a>
            <a data-type="bla">
                <img src="OK2">
            </a>
        </div>
    </body>
</html>
HTML;

$crawler = new Crawler($html);

$link = $crawler->filter('#product a[data-type="bla"]');

echo  (count($link));

foreach ($link  as $each) {
    var_dump($each->getElementsByTagName('img')->item(0));
}

