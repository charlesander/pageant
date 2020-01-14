    <?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /** @BeforeScenario */
    public function gatherContexts(
        \Behat\Behat\Hook\Scope\BeforeScenarioScope $scope
    )
    {
        $this->apiContext = $scope
            ->getEnvironment()
            ->getContext(
                \Imbo\BehatApiExtension\Context\ApiContext::class
            )
        ;
    }

    /**
     * @Given there are Contacts with the following details:
     */
    public function thereAreContactsWithTheFollowingDetails(TableNode $table)
    {
        throw new PendingException();
    }
}
