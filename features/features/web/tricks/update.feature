@web
@web_update_trick

Feature: As an authenticated user,  I want to create a trick
  Background:
    Given I load fixture file "fixtures.yml"
  Scenario: [Fail] submit without data
    Then I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/update/trick/1080"
    And I press "Envoyer"
    And I should be on "/"
  Scenario: [Success] update a trick
    Then I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/update/trick/1080"
    And I fill in "Name" with "name"
    And I fill in "Description" with "description"
    And I fill in "Category" with "group"
    And I fill in "File" with "/Users/romss/Documents/SnowTricks/public/images/Upload/540.svg"
    And I fill in "Legend" with "legend"
    And I fill in "File" with "/Users/romss/Documents/SnowTricks/public/images/Upload/360.svg"
    And I fill in "Legend" with "legend"
    And I fill in "Embed" with "embed"
    And I fill in "Legend" with "legend"
    And I press "Envoyer"