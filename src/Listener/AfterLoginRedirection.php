<?php


namespace App\Listener;


use App\Security\Role;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        $roles = $token->getRoleNames();

        if (in_array(Role::ROLE_ADMIN, $roles, true)) {
            return new RedirectResponse($this->router->generate('admin_index'));
        }
        if (in_array(Role::ROLE_MEMBER, $roles, true)) {
            return new RedirectResponse($this->router->generate('member_index'));
        }

        //Cas où l'utilisateur n'a ni le rôle member ni le rôle admin
        return new RedirectResponse($this->router->generate('login'));
    }
}