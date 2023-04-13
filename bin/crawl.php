<?php

declare(strict_types=1);

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Spatie\Crawler\CrawlProfiles\CrawlProfile;

require_once __DIR__ . '/../vendor/autoload.php';

$profile = new class extends CrawlProfile {
    public function shouldCrawl(UriInterface $url): bool
    {
        return $url->getHost() === 'people.php.net' &&
            (str_starts_with($url->getPath(), '/a') || $url->getPath() === '/');
    }
};

$observer = new class extends CrawlObserver {
    public function crawled(UriInterface $url, ResponseInterface $response, ?UriInterface $foundOnUrl = null): void
    {
        if ($url->getQuery() !== '' || $response->getStatusCode() !== 200 || $url->getPath() === '/') {
            return;
        }
        $domCrawler = new Symfony\Component\DomCrawler\Crawler((string)$response->getBody());
        $name = $domCrawler->filter('h1[property="foaf:name"]')->first()->text();
        $nick = $domCrawler->filter('h2[property="foaf:nick"]')->first()->text();
        $email = "{$nick}@php.net";

        echo "[{$email}] {$name} - {$nick}" . PHP_EOL;
    }

    public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null): void
    {
        echo $requestException->getMessage() . PHP_EOL;
    }
};


Crawler::create()
    ->setCrawlProfile($profile)
    ->setCrawlObserver($observer)
    ->setDelayBetweenRequests(500)
    ->startCrawling('https://people.php.net/');

