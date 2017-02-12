<?php

namespace Web\Exception;

use Exception;

class HttpException extends \RuntimeException
{
    /**
     * @var int string
     */
    protected $status;

    /**
     * @param int $status
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(int $status, $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}