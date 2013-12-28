<?php

namespace WebScraper;

use Goutte\Client;

class Scraper
{

/**
* @author Younes
**/

	private $client = NULL;
	private $options = array();
	private static $gscraper = NULL;

	private function __construct(Client $clt, array $opts, $path)
	{
		$this->client = $clt;
		$this->options = $opts;
		$this->scrapeWebPages($path);
	}

	static function startScraping(Client $clt, array $opt = null, $path)
	{
		self::$gscraper = new Scraper($clt, $opt, $path);
		return self::$gscraper;
	}

	private function getSearchLink($page)
	{
		$source = $this->options['source'];
		$keywordParameter = $this->options['keywordParameter'];
		$keyword = $this->options['keyword'];
		$pageParameter = $this->options['pageParameter'];
		$searchLink = $source . $keywordParameter . '=' . $keyword . '&' . $pageParameter . '=' . $page;// . '&tbm=pts';
		return $searchLink;
	}

	private function getContentLink($result)
	{
		return $this->options['domain_name'] . $result->getAttribute('href');
	}

	private function createFile($pathFile, $resultContent)
	{
		$file = fopen($pathFile, 'w');
        fputs($file, $resultContent);
        fclose($file);
	}

	private function scrapeWebPages($folderPath)
	{
		$resultLinkFilter = $this->options['result_link'];
		$resultContentFilter = $this->options['result_content'];

		$incrementPage = $this->options['incrementPage'];

		$resultNumber = 1;

		for ($page=0; $page < 10*$incrementPage; $page += $incrementPage) { 

			$resultSearchLink = $this->getSearchLink($page);

			echo $resultSearchLink . "\n";

			$crawler = $this->client->request('GET', $resultSearchLink);
			var_export($crawler);

			$results = $crawler->filter($resultLinkFilter);
			var_export($results->count());

			if ($results->count() === 0) {
				echo "\nScraping is done.\n";
				break;
			}

			foreach ($results as $result) {
				$resultContentLink = $this->getContentLink($result);

				$crawler = $this->client->request('GET', $resultContentLink);

				$resultContent = $crawler->filter($resultContentFilter)->html();

				$filePath = "{$folderPath}/Result_n_{$resultNumber}.html";

				$this->createFile($filePath, $resultContent);
				echo "\nFile #{$resultNumber} has been created.";
				$resultNumber++;
			}
		}

	}
}