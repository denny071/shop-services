<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

/**
 * 内部异常
 *
 * Class InternalException
 * @package App\Exceptions
 */
class InternalException extends Exception
{
    protected $msgForUser;

    public function __construct(string $message, string $msgForUser = '系统内部错误', int $code = 500)
    {
        parent::__construct($message, $code);
        $this->msgForUser = $msgForUser;
    }

    public function render(Request $request)
    {
        return response()->json(['msg' => $this->msgForUser], $this->code);
    }
}
