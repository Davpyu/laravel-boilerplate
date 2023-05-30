<?php

namespace App\Interfaces\Services;

interface IService
{
    public function responseSuccess(string $message = 'Success.');
    public function responseWithData(array $data);
    public function responseWithToken(string $token);
    public function responseResourceCreated(string $message = 'Resource created.');
    public function responseUnauthorized(string $errors = 'Unauthorized.');
    public function responseUnprocessable(string $errors);
    public function responseServerError(string $errors = 'Server error.');
}