<?php

namespace App\Twig;

use App\Entity\Team;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppExtension extends \Twig_Extension implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'app';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('captain', array($this, 'getTeamCaptain'))
        );
    }

    /**
     * @param Team $team
     * @return \App\Entity\Player
     */
    public function getTeamCaptain(Team $team)
    {
        $playerRepo = $this->container->get('app.entity.player_repository');

        return $playerRepo->getCaptainForTeam($team);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
} 