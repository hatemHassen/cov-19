<?php


namespace App\Infrastructure\Action\Login;


use App\Infrastructure\Action\Action;
use Exception;

class LogoutUserAction implements Action
{
    /**
     * @throws Exception
     */
    public function __invoke()
    {
        throw new \RuntimeException('Don\'t forget to activate logout in security.yaml');
    }

}