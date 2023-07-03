@api
Feature: Module Status
  In order to verify module status
  As a Drupal site administrator
  I want to check if modules are enabled or not

  Scenario: Check if required modules are enabled
    Given I am logged in as an administrator
    When I go to the modules page
    Then I should see the following modules enabled:
      | Module Name  |
      | pathauto    |
      | twig_tweak  |
      | token |
      | paragraphs |
      | book |

