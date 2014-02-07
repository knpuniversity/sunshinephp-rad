<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Team;

class TeamController extends Controller
{
    /**
     * @param Team[] $teams
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(array $teams)
    {
        return array('teams' => $teams);
    }
}
