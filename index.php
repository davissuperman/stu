<?php
use Symfony\Component\DomCrawler;
require 'Bootstrap.php';

$dom = \HTML5::loadHTMLFile('https://engineeredweb.com/blog/2014/symfony-domcrawler-html5-php/');
$crawler = new \Symfony\Component\DomCrawler\Crawler($dom);
var_dump($crawler);