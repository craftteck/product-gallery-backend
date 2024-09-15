<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class OptimisticLockException extends HttpException
{
    public function __construct()
    {
        // 409 Conflict のステータスコードとエラーメッセージを指定
        parent::__construct(409, 'The record has been modified by another process.');
    }
}
