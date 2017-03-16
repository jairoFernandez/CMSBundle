<?php

namespace Tucompu\CmsBundle\Twig;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Tucompu\CmsBundle\Entity\Menu;

class MenuExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    protected $em;
    protected $contextAuth;
    protected $container;
    protected $contextToken;

    public function __construct($entityManager, $container, AuthorizationChecker $contextAuth, TokenStorage $contextToken)
    {
        $this->em = $entityManager;
        $this->contextAuth = $contextAuth;
        $this->container = $container;
        $this->contextToken = $contextToken;
    }

    public function getGlobals()
    {
        $menu = $this->em->getRepository(Menu::class)->findBy(array(
            'isActive' => true
        ),array(
            'position' => 'ASC'
        ));

        return array(
            'menus' => $menu
        );
    }

    public function getName()
    {
        return 'menu_extension';
    }
}