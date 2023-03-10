<?php

/**
 * Implement autoload for controller classes
 */
spl_autoload_register(function ($className) {
  $file = __DIR__ . "/../api/controller/" . $className . ".php";
  if (file_exists($file)) {
    require_once $file;
  }
});

class Request
{
  # Targeted request
  private $_request = null;

  /**
   * Initiate request
   * @param RequestObject incoming request
   */
  public function __construct($request)
  {
    $this->_request = $request;
  }

  /**
   * Handle get request
   * @param string class name
   * @param string method name
   * @param string parameter
   * @return Request
   */
  public function GET(
    string $class,
    string $method,
    string $parameter = ""
  ): Request {
    if ($this->_request["REQUEST_METHOD"] === "GET") {
      call_user_func([$class, $method], $parameter);
    }
    return $this;
  }

  /**
   * Handle post request
   * @param string class name
   * @param string method name
   * @param string parameter
   * @return Request
   */
  public function POST(string $class, string $method, $parameter = ""): Request
  {
    if ($this->_request["REQUEST_METHOD"] === "POST") {
      call_user_func([$class, $method], $parameter);
    }
    return $this;
  }

  /**
   * Handle patch request
   * @param string class name
   * @param string method name
   * @param string parameter
   * @return Request
   */
  public function PATCH(string $class, string $method, $parameter = ""): Request
  {
    if ($this->_request["REQUEST_METHOD"] === "PATCH") {
      call_user_func([$class, $method], $parameter);
    }
    return $this;
  }

  /**
   * Handle delete request
   * @param string class name
   * @param string method name
   * @param string parameter
   * @return Request
   */
  public function DELETE(
    string $class,
    string $method,
    $parameter = ""
  ): Request {
    if ($this->_request["REQUEST_METHOD"] === "DELETE") {
      call_user_func([$class, $method], $parameter);
    }
    return $this;
  }

  /**
   * Handle options request
   * @return Request
   */
  public function OPTIONS(): Request
  {
    if ($this->_request["REQUEST_METHOD"] === "OPTIONS") {
      http_response_code(204);
      exit();
    }
    return $this;
  }

}