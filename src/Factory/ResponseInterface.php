<?php

namespace aomd\Docker\Factory;

use aomd\Docker\Lib\Socket;

interface ResponseInterface extends HttpInterface
{

  /**
   * 获取 HTTP 返回状态码
   *
   * @return int
   */

  public function getStatusCode();

  /** 
   * 设置 HTTP 返回状态码和请求信息
   *
   * @param int     状态码
   * @param string  状态信息
   */

  public function setStatusCode(int $code, string $statusInfo = '');

  /** 
   * 读取数据信息
   *
   */
  public function readResponse(Socket $currentSocket, SocketInterface $socket);
}
