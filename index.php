<?php

require_once __DIR__ . '/vendor/autoload.php';

use Goutte\Client;
use WebScraper\Scraper;

$client = new Client();

// Scraping FreePatentsOnline : "RFID"

$options = array(
		'domain_name' => 'http://www.freepatentsonline.com',	// The search engine domain name
		'source' => 'http://www.freepatentsonline.com/result.html?',	// The results' search URL (without parameters)
		'result_link' => '.listing_table a',	// The DOM element of the patents' links in the results' search page
		'result_content' => '.document-details-wrapper', 	// The DOM element of the content in the patent page (the content to be scraped and stored in the given path - below)
		'pageParameter' => 'p',	// The page parameter in the results' search URL
		'incrementPage' => 1,	// The value that increments the results' search pages
		'keywordParameter' => 'query_txt',	// The keyword parameter in the results' search URL
		'keyword' => 'RFID',	// The keyword to search
				);


$path = "/opt/lampp/htdocs/Scraper/results/";	// The path of the folder all files will be downloaded in

Scraper::startScraping($client, $options, $path);	// Starts the scraping