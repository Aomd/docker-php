<?php

namespace aomd\Docker\Module;

use aomd\Docker\Factory\SocketInterface;
use aomd\Docker\Factory\ResponseInterface;


class Module
{
	protected $response = null;

	protected $socket   = null;

	protected $query    = null;

	public function __construct(SocketInterface $socket, ResponseInterface $response )
	{
		$this->socket   = $socket;
		$this->response = $response;
	}

}