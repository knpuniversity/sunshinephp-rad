<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Team;
use Knp\RadBundle\Controller\Controller;

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

    /**
     * @param Team $team
     * @return array
     */
    public function showAction(Team $team)
    {
        return array('team' => $team);
    }

    public function editAction(Team $team)
    {
        $form = $this->createBoundObjectForm($team, 'edit', array(
            'method' => 'PUT',
            'action' => $this->generateUrl('app_team_update', array('id' => $team->getId()))
        ));

        if ($form->isValid()) {
            $this->persist($team, true);
            $this->addFlash('success');

            return $this->redirectToRoute('app_team_show', array(
                'id' => $team->getId()
            ));
        }

        return ['form' => $form->createView(), 'team' => $team];
    }

    public function newAction()
    {
        $team = new Team();
        $form = $this->createBoundObjectForm($team, 'new', array(
            'method' => 'POST',
            'action' => $this->generateUrl('app_team_create', array('id' => $team->getId()))
        ));

        if ($form->isValid()) {
            $this->persist($team, true);
            $this->addFlash('success');

            return $this->redirectToRoute('app_team_show', array(
                'id' => $team->getId()
            ));
        }

        return ['form' => $form->createView(), 'team' => $team];
    }

    public function deleteAction(Team $team)
    {
        $this->remove($team, true);

        return $this->redirectToRoute('app_team_index');
    }
}
