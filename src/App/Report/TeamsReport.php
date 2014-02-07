<?php

namespace App\Report;

use App\Entity\TeamRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Entity\Team;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.teams_report")
 */
class TeamsReport
{
    /**
     * @var \App\Entity\TeamRepository
     */
    public $teamRepo;

    /**
     * @var \Symfony\Component\Routing\Generator\UrlGenerator
     */
    public $urlGenerator;

    /**
     * @param TeamRepository $teamRepo
     * @param UrlGeneratorInterface $generator
     * @DI\InjectParams({
     *      "teamRepo" = @DI\Inject("app.entity.team_repository"),
     *      "generator" = @DI\Inject("router")
     * })
     */
    public function __construct(TeamRepository $teamRepo, UrlGeneratorInterface $generator)
    {
        $this->teamRepo = $teamRepo;
        $this->urlGenerator = $generator;
    }

    public function generateReport()
    {
        $data = [];
        foreach ($this->teamRepo->findAll() as $team) {
            /** @var $team Team */
            $data[] = array(
                'name' => $team->getName(),
                'members' => count($team->getPlayers()),
                'url' => $this->urlGenerator->generate(
                    'app_team_show',
                    array('id' => $team->getId()),
                    true
                )
            );
        }

        return $data;
    }
} 