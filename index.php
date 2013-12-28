<?php

require_once __DIR__ . '/vendor/autoload.php';

use Goutte\Client;
use WebScraper\Scraper;

$client = new Client();

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