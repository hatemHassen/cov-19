<?php


namespace App\Infrastructure\Back\Action\Login;


use App\Infrastructure\Traits\RoutingTrait;
use App\Infrastructure\Traits\UserTrait;
use App\Infrastructure\Utils\Action\Action;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class LoginUserAction implements Action
{
    use UserTrait;
    use RoutingTrait;

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @param Environment $environment
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(AuthenticationUtils $authenticationUtils, Environment $environment)
    {
        $user = $this->getUser();
        if ($user instanceof UserInterface) {
            return $this->redirectToRoute('dashboard');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response(
            $environment->render('back/security/login.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ])
        );
    }

}