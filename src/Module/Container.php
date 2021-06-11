<?php

namespace aomd\Docker\Module;

use aomd\Docker\Lib\Request;

/**
 * dpcker api version 1.41 
 *
 * @Author Aomd g00665@163.com
 * @DateTime 2021-06-11
 */
class Container extends Module
{

  public function list($params = [])
  {
    $request  = new Request('GET', 'http://127.0.0.1/containers/json');

    $request->setPayload([
      'all' => false,
      'limit' => 10,
      'size' => false,
      'filters' => null
    ]);

    $request->setPayload($params);
    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function create($params = [])
  {
    $request  = new Request('POST', 'http://127.0.0.1/containers/create');

    $request->setPayload([
      // 默认名称时间戳
      'name' => time(),
    ]);

    $request->setPayload($params);
    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }



  public function inspect($id, $params = [])
  {
    $request  = new Request('GET', 'http://127.0.0.1/containers/' . $id . '/json');

    $request->setPayload([
      'size' => false,
    ]);

    $request->setPayload($params);
    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function top($id, $params = [])
  {
    $request  = new Request('GET', 'http://127.0.0.1/containers/' . $id . '/top');

    $request->setPayload([
      'ps_args' => "-ef",
    ]);

    $request->setPayload($params);
    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function logs($id, $params = [])
  {

    $request  = new Request('GET', 'http://127.0.0.1/containers/' . $id . '/logs');

    $request->setPayload([
      'follow' => false,
      'stdout' => true,
      'stderr' => true,
      'since' => 0,
      'timestamps' => true,
      'tail' => 'all',
    ]);

    $request->setPayload($params);
    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function changes($id)
  {
    $request  = new Request('GET', 'http://127.0.0.1/containers/' . $id . '/changes');

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function export($id)
  {
    $request  = new Request('GET', 'http://127.0.0.1/containers/' . $id . '/export');

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }


  public function stats($id, $params = [])
  {
    $request  = new Request('GET', 'http://127.0.0.1/containers/' . $id . '/stats');

    $request->setPayload([
      'stream' => false,
      'one-shot' => false,
    ]);

    $request->setPayload($params);

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function resize($id, $params = [])
  {
    $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/resize');

    $request->setPayload([
      'h' => 300,
      'w' => 400,
    ]);

    $request->setPayload($params);

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function start($id, $params = [])
  {
    $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/start');

    $request->setPayload([
      'detachKeys' => '',
    ]);

    $request->setPayload($params);

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function stop($id, $params = [])
  {
    $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/stop');

    $request->setPayload([
      't' => 0,
    ]);

    $request->setPayload($params);

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function restart($id, $params = [])
  {
    $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/restart');

    $request->setPayload([
      't' => 0,
    ]);

    $request->setPayload($params);

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }

  public function kill($id, $params = [])
  {
    $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/kill');

    $request->setPayload([
      'signal' => 'SIGKILL',
    ]);

    $request->setPayload($params);

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }


  public function update($id, $params = [])
  {
    // $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/update');

    // $request->setPayload([
    //   'signal' => 'SIGKILL',
    // ]);

    // $request->setPayload($params);

    // $response = $request->sendRequest($this->socket, $this->response);
    // return $response->getPayloads();
  }

  public function rename($id, $params = [])
  {

    $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/rename');

    $request->setPayload([
      'name' => time(),
    ]);

    $request->setPayload($params);

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }


  public function pause($id, $params = [])
  {

    $request  = new Request('POST', 'http://127.0.0.1/containers/' . $id . '/pause');

    $response = $request->sendRequest($this->socket, $this->response);
    return $response->getPayloads();
  }
}
