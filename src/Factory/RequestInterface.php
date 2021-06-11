<?php

namespace aomd\Docker\Factory;

interface RequestInterface extends HttpInterface
{

  /**
   * 设置请求方法
   *
   * @param 
   */

  public function setMethod(string $method);

  /**
   * 获取当前的请求方法
   *
   * @return string
   */

  public function getMethod();

  /**
   * 设置请求的url
   * 
   * @param string
   */

  public function setUri(string $uri);

  /**
   * 获取请求的url
   * 
   * @return string
   */

  public function getUri();


  /**
   * 设置 装载
   * 设置 请求数据
   *
   * @return void
   */
  public function setPayload(array $Payloads);


  /**
   * 删除 装载
   * 删除 请求数据
   *
   * @param string $name
   * @return void
   */
  public function removePayload(string $name);


  /**
   * 向服务发送 resquest 请求
   * 
   * @return string
   */
  public function sendRequest(SocketInterface $socket, ResponseInterface $response);
}
