<?php
/**
 * The interface those who use our caching know, real simple, you can set a value
 * for a key or get a value from a key.
 */
interface ICache
{
	public function get($key);
	public function set($key, $value);
}

class Cache implements ICache
{
	public function get($key)
	{
	}

	public function set($key, $value)
	{
	}
}