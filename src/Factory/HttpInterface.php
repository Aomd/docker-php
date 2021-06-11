<?php

namespace aomd\Docker\Factory;

interface HttpInterface
{
  /**
   * 返回 HTTP 版本信息 1.0||1.1 
   *
   * @return string
   */

  public function getProtocolVersion();

  /**
   * 设置 HTTP 版本信息 1.0||1.1 
   *
   * @param  string 版本信息
   * @return void
   */

  public function setProtocolVersion(string $version);

  /**
   * 返回 HTTP 头部信息 
   *
   * @return array  
   */

  public function getHeaders();

  /**
   * 设置 HTTP 头部信息
   * 
   * @param  string[]  name => value
   * @return void
   */

  public function setHeader(array $header);

  /**
   * 获取某个头部的信息
   * 
   * @param  string  例如 HOST
   * @return string|bool 
   */

  public function getHeader(string $name);

  /**
   * 删除某个头部信息
   *
   * @param string  例如 HOST
   */

  public function removeHeader(string $name);

  /**
   * 获取 装载 信息
   * 
   * 获取请求所有数据
   * 
   * @return
   */

  public function getPayloads();
}
