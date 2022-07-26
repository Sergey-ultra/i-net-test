<?php

declare(strict_types=1);

interface HttpServiceInterface
{
    public function request(string $url, string $type = 'GET', array $options = []): string;
}

class XMLHTTPRequestService implements HttpServiceInterface
{
    public function request(string $url, string $type = 'GET', array $options = []): string
    {
        return 'done';
    }
}

class XMLHttpService implements HttpServiceInterface
{
    public function request(string $url, string $type = 'GET', array $options = []): string
    {
        return 'quick done';
    }
}

class Http {
    private HttpServiceInterface $service;

    public function __construct(HttpServiceInterface $xmlHttpService)
    {
        $this->service = $xmlHttpService;
    }

    public function get(string $url, array $options = []): string
    {
        return $this->service->request($url, 'GET', $options);
    }

    public function post(string $url): string
    {
        return $this->service->request($url, 'POST');
    }
}