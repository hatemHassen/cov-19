<?php


namespace App\Infrastructure\Back\Action\Dashboard;

use App\Application\Query\ListTownQuery;
use App\Infrastructure\Utils\Action\Action;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class DashboardAction implements Action
{
    private $listTownQuery;

    public function __construct(ListTownQuery $listTownQuery)
    {
        $this->listTownQuery = $listTownQuery;
    }

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

        return new Response($environment->render('back/dashboard/index.html.twig',[
            'towns' => $this->listTownQuery->execute(),
        ]));
    }

}