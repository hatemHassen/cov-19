<?php

namespace App\Infrastructure\Traits;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * UserTrait.
 */
trait UserTrait
{
    /** @var User $user */
    protected $user;

    /** @var TokenStorageInterface $tokenStorage */
    protected $tokenStorage;

    /** @var AuthorizationCheckerInterface $authorizationChecker */
    protected $authorizationChecker;

    /** @var SessionInterface $session */
    protected $session;

    /**
     * @return AuthorizationCheckerInterface
     */
    public function getAuthorizationChecker(): AuthorizationCheckerInterface
    {
        return $this->authorizationChecker;
    }

    /**
     * @required
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function setAuthorizationChecker(AuthorizationCheckerInterface $authorizationChecker): void
    {
        $this->authorizationChecker = $authorizationChecker;
    }


    /**
     * @return TokenStorageInterface
     */
    public function getTokenStorage(): TokenStorageInterface
    {
        return $this->tokenStorage;
    }

    /**
     * @param TokenStorageInterface $tokenStorage
     * @required
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage): void
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return object|string
     */
    public function getUser()
    {
        if ($token = $this->tokenStorage->getToken()) {
            $this->user = $token->getUser();
        }

        return $this->user;
    }

    /**
     * @param $attributes
     * @param null $subject
     * @return bool
     */
    public function isGranted($attributes, $subject = null): bool
    {
        return $this->authorizationChecker->isGranted($attributes, $subject);
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    /**
     * @param SessionInterface $session
     * @return self
     * @required
     */
    public function setSession(SessionInterface $session): self
    {
        $this->session = $session;
        return $this;
    }

    public function __get($method)
    {
        if ($this->session->has($method)) {
            return $this->session->get($method);
        }

        return false;
    }

}