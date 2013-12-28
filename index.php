<?php

require_once 'goutte.phar';
require_once __DIR__ . '/src/autoload.php';

use Goutte\Client;
use WebScraper\Scraper;

$client = new Client();

// $options = array(
// 		'domain_name' => 'https://www.google.com/?tbm=pts',
// 		'source' => 'https://www.google.com/?tbm=pts#',
// 		'result_link' => 'h3.r a',
// 		'result_content' => '#intl_patents_v',
// 		'pageParameter' => 'start',
// 		'incrementPage' => 10,
// 		'keywordParameter' => 'q',
// 		'keyword' => 'rfid',
// 				);



// FreePatentsOnline =>
$options = array(
		'domain_name' => 'http://www.freepatentsonline.com',
		'source' => 'http://www.freepatentsonline.com/result.html?',
		'result_link' => '.listing_table a',
		'result_content' => '.document-details-wrapper',
		'pageParameter' => 'p',
		'incrementPage' => 1,
		'keywordParameter' => 'query_txt',
		'keyword' => 'rfid',
				);


$path = "/opt/lampp/htdocs/Scraper/results/";

Scraper::startScraping($client, $options, $path);