<?php

namespace aomd\Docker\Lib;

use aomd\Docker\Factory\RequestInterface;
use aomd\Docker\Factory\ResponseInterface;
use aomd\Docker\Factory\SocketInterface;

class Request implements RequestInterface
{

  /**
   * 请求 version,默认使用 1.0
   */

  private $protocol = '1.0';

  /**
   * @var 请求方法
   */

  private $method = 'GET';

  /**
   * @var header 请求head头数组
   */

  private $header = [];

  /**
   * @var body 请求信息的 装载
   */

  private $Payloads = [];

  /**
   * @var url 地址
   */

  private $uri = null;

  /**
   * 实列化 Request 类
   *
   * @param string $method  请求方法
   * @param string $uri     请求url
   * @param array  $headers 请求头部数组
   * @param mix    $body    可以为空，字符串和Resource
   * @param string $protocol HTTP的协议版本
   */

  public function __construct(string $method, string $uri, array $headers = [], string $protocol = '1.0')
  {
    $this->method = strtoupper($method);
    $this->uri    = $uri;
    $this->setHeader($headers);
    $this->protocol  = $protocol;
  }

  /**
   * 返回 HTTP 版本信息 1.0||1.1 
   *
   * @return string
   */

  public function getProtocolVersion()
  {
    return $this->protocol;
  }

  /**
   * 设置 HTTP 版本信息 1.0||1.1 
   *
   * @param  string 版本信息
   * @return void
   */

  public function setProtocolVersion(string $protocol)
  {
    $this->protocol = $protocol;
  }

  /**
   * 返回 HTTP 头部信息 
   *
   * @return array  
   */

  public function getHeaders()
  {
    return $this->header;
  }

  /**
   * 设置 HTTP 头部信息
   * 
   * @param  string[]  name => value
   * @return void
   */

  public function setHeader(array $header)
  {
    foreach ($header as $name => $value) {
      $this->header[$name] = $value;
    }
  }

  /**
   * 获取某个头部的信息
   * 
   * @param  string  例如 HOST
   * @return string|bool 
   */

  public function getHeader(string $name)
  {
    if (isset($this->header[$name]) && !empty($this->header[$name])) {
      return $this->header[$name];
    }
    return '';
  }

  /**
   * 删除某个头部信息
   *
   * @param string  例如 HOST
   */

  public function removeHeader(string $name)
  {
    if (isset($this->header[$name]) && !empty($this->header[$name])) {
      unset($this->header[$name]);
      return true;
    }
    return false;
  }

  /**
   * 获取 装载 信息
   * 获取请求所有数据
   * 
   * @return array
   */
  public function getPayloads()
  {
    return $this->Payloads;
  }

  /**
   * 设置 装载
   * 设置 请求数据
   *
   * @param array $Payloads
   * @return void
   */
  public function setPayload(array $Payloads)
  {
    foreach ($Payloads as $name => $value) {
      $this->Payloads[$name] = $value;
    }
  }

  /**
   * 删除 装载
   * 删除 请求数据
   * 
   * @param string $name
   * @return void
   */
  public function removePayload(string $name)
  {
    if (isset($this->Payloads[$name]) && !empty($this->Payloads[$name])) {
      unset($this->Payloads[$name]);
      return true;
    }
    return false;
  }




  /**
   * 设置请求方法
   *
   * @param 
   */

  public function setMethod($method)
  {
    $this->method = strtoupper($method);
  }

  /**
   * 获取当前的请求方法
   *
   * @return string
   */

  public function getMethod()
  {
    return $this->method;
  }

  /**
   * 设置请求的url
   * 
   * @param string
   */

  public function setUri($uri)
  {
    $this->uri = $uri;
  }

  /**
   * 获取请求的url
   * 
   * @return string
   */

  public function getUri()
  {
    return $this->uri;
  }

  /**
   * 获取拼接好的 Request 信息
   */

  public function getRequestHeader()
  {
    if ($this->method == 'GET') {

      $url = $this->getUri() . '?' . http_build_query($this->getPayloads());
    } else {
      $url  = $this->getUri();
    }
    $separator = "\r\n";

    $requestHeader = vsprintf('%s %s HTTP/%s', [
      strtoupper((string) $this->method),
      $url,
      $this->protocol
    ]) . $separator;

    if (count((array) $this->header) != 0) {
      foreach ($this->header as $name => $value) {
        $requestHeader .= $name . ':' . $value . $separator;
      }
    }

    $requestHeader .= $separator;

    return $requestHeader;
  }


  public function getRequestPayload()
  {
    if ($this->method == 'GET') {
      return '';
    }
    $separator = "\r\n";

    $requestPayload = json_encode($this->getPayloads());

    return $requestPayload . $separator;
  }



  /**
   * 向服务器发送Request请求
   * 
   * @param  resource        $socket 当前的连接的Socket信息
   * @param  responseObject  aomd\Docker\Factory\ResponseInterface
   * @return responseObject  aomd\Docker\Factory\ResponseInterface
   */

  public function sendRequest(SocketInterface $socket, ResponseInterface $response)
  {
    $currentSocket = null;
    $currentSocket = $socket->getSocket();
    // 如果当前的 Socket 未空 
    if ($currentSocket == null) throw new \Exception("Socket Connect Error");
    
    fwrite($currentSocket, $this->getRequestHeader() . $this->getRequestPayload());

    return  $response->readResponse($currentSocket, $socket);
  }
}
