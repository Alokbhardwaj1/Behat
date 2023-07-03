<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Drupal\DrupalExtension\Context\RawDrupalContext;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext implements Context
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

    /**
     * @When I go to the modules page
     */
    public function iGoToTheModulesPage()
    {
        $this->getSession()->visit($this->locatePath('/admin/modules'));
    }

    /**
     * @Then I should see the following modules enabled:
     */
    public function iShouldSeeTheFollowingModulesEnabled(\Behat\Gherkin\Node\TableNode $table)
    {   
        $enabledModules = \Drupal::service('module_handler')->getModuleList();
        $enabledModuleNames = array_keys($enabledModules);

        $columnValues = array_column($table->getColumnsHash(), 'Module Name');
        $missingModules = array_diff($columnValues, $enabledModuleNames);        
        if (!empty($missingModules)) {
            $missingModulesString = implode(', ', $missingModules);
            throw new \Exception("The following modules are missing or not enabled: $missingModulesString");
        }
    }
}
