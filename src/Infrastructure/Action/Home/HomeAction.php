<?php


namespace App\Infrastructure\Action\Home;

use App\Application\Query\ListTownQuery;
use App\Infrastructure\Action\Action;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeAction implements Action
{

    /**
     * @param Request $request
     * @param Environment $environment
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(Request $request, Environment $environment): Response
    {

        return new Response($environment->render('front/home/index.html.twig'));
    }

}