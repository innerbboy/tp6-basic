<?php
declare (strict_types = 1);

namespace app\exception;

/**
 * HTTP异常
 */
class HttpExceptions extends \RuntimeException
{
    private $statusCode;
    private $headers;

    public function __construct(int $statusCode, string $message = null, $code = 0, \Exception $previous = null, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->headers    = $headers;

        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}
