<?php

/**
 * Base for a simple REST client
 */
class RestClient
{
	private $cache;
	private $logger;

	/**
	 * We depend on a cache and a logger and recieve them via Dependency Injection, read more:
	 * http://misko.hevery.com/2008/07/08/how-to-think-about-the-new-operator/
	 */
	public function __construct(ICache $cache, ILog $logger)
	{
		$this->cache = $cache;
		$this->logger = $logger;
	}

	/**
	 * Perform a request to $url using $method and returns the result.
	 * If $json is true, the response will be decoded before being returned
	 */
	public function Request($url, $method = 'GET', $json = false)
	{
	}
}