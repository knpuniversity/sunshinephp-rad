<?php

namespace App\Features\Context;

use App\Entity\Team;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Behat\Behat\Context\Step\Given;
use Behat\Behat\Context\Step\When;
use Behat\Behat\Context\Step\Then;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

require_once __DIR__.'/../../../../vendor/phpunit/phpunit/PHPUnit/Autoload.php';
require_once __DIR__.'/../../../../vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

class FeatureContext extends MinkContext implements KernelAwareInterface
{
    private $kernel;

    /**
     * @Given /^there are (\d+) teams$/
     */
    public function thereAreTeams($num)
    {
        $faker = $this->createFaker();
        for ($i = 0; $i < $num; $i++) {
            $team = new Team();
            $team->setName($faker->name);
            $team->setDescription($faker->paragraph());

            $this->getEntityManager()->persist($team);
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @When /^I click "([^"]*)"$/
     */
    public function iClick($linkName)
    {
        return new When(sprintf('I follow "%s"', $linkName));
    }

    /**
     * @Then /^I should see (\d+) rows in the table$/
     */
    public function iShouldSeeRowsInTheTable($rowCount)
    {
        $table = $this->getPage()->find('css', 'table');
        assertNotNull($table, 'Cannot find a table!');

        $rows = $table->findAll('css', 'tbody tr');

        assertCount(intval($rowCount), $rows);
    }

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel HttpKernel instance
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    private function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     * @return \Behat\Mink\Element\DocumentElement
     */
    public function getPage()
    {
        return $this->getSession()->getPage();
    }

    /**
     * @return \Faker\Generator
     */
    public function createFaker()
    {
        return \Faker\Factory::create();
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * Clears the database before every scenario
     *
     * @BeforeScenario
     */
    public function clearDatabase()
    {
        $purger = new ORMPurger($this->getEntityManager());
        $purger->purge();
    }
}
