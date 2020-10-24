<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;


/**
 * 请求异常
 *
 * Class InvalidRequestException
 * @package App\Exceptions
 */
class InvalidRequestException extends Exception
{
    public function __construct(string $message = "", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render(Request $request)
    {
        return response()->json(['msg' => $this->message], $this->code);
    }
}
