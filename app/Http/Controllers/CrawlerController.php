<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Spatie\Crawler\CrawlProfiles\CrawlProfile;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class CrawlerController extends Controller
{
  public function index(Request $request)
  {
    $crawl_type = $request->get('crawl_type');
    $url = $request->input('url'); // Get the URL from POST data
    $file_extension = $request->input('file_extension'); // Get the URL from POST data
    $results = [];

    if (!$file_extension) {
      if($url) {
        $profile = new class extends CrawlProfile {
            public function shouldCrawl(UriInterface $url): bool
            {
                return $url->getHost() === 'people.php.net' &&
                    (str_starts_with($url->getPath(), '/a') || $url->getPath() === '/');
            }
        };

        $observer = new class extends CrawlObserver {
            private $results = []; // Array to store the crawling results

            public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null): void
            {
                if ($url->getQuery() !== '' || $response->getStatusCode() !== 200 || $url->getPath() === '/') {
                    return;
                }
                $domCrawler = new DomCrawler((string)$response->getBody());
                $name = $domCrawler->filter('h1[property="foaf:name"]')->first()->text();
                $nick = $domCrawler->filter('h2[property="foaf:nick"]')->first()->text();
                $email = "{$nick}@php.net";

                $this->results[] = "[{$email}] {$name} - {$nick}"; // Add the result to the array
            }

            public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null): void
            {
                echo $requestException->getMessage() . PHP_EOL;
            }

            public function getResults(): array // Getter for the results array
            {
                return $this->results;
            }
        };


        Crawler::create()
            ->setCrawlProfile($profile)
            ->setCrawlObserver($observer)
            ->setDelayBetweenRequests(0)
            ->setTotalCrawlLimit(10)
            ->startCrawling($url);

        $results = $observer->getResults(); // Get the crawling results from the observer
      }
    }
    elseif($file_extension) {
      $profile = new class extends CrawlProfile {
          public function shouldCrawl(UriInterface $url): bool
          {
              // return $url->getHost() === 'people.php.net' &&
              //     (str_ends_with($url->getPath(), 'g') || $url->getPath() === '/');
              return true;
          }
      };

      $observer = new class($file_extension)  extends CrawlObserver {
          private $file_extension;
          private $results = []; // Array to store the crawling results

          public function __construct($file_extension)
          {
              $this->file_extension = $file_extension;
          }

          public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null): void
          {
              if (!str_ends_with($url->getPath(), $this->file_extension) || $url->getQuery() !== '' || $response->getStatusCode() !== 200 || $url->getPath() === '/') {
                   return;
              }
              $this->results[] = $url; // Add the result to the array
          }

          public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null): void
          {
      //        echo $requestException->getMessage() . PHP_EOL;
          }
          public function getResults(): array // Getter for the results array
          {
              return $this->results;
          }
      };



      Crawler::create()
          ->setCrawlProfile($profile)
          ->setCrawlObserver($observer)
          ->setDelayBetweenRequests(0)
          ->setTotalCrawlLimit(100)
          ->startCrawling($url);
      $results = $observer->getResults(); // Get the crawling results from the observer
    }



    return view('index', ['results' => $results, 'url' => $url, 'crawl_type' => $crawl_type, 'file_extension' => $file_extension]); // Pass the results to the view

  }
}
