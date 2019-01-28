@web
@web_delete_trick

Feature: As an authenticated user,  I want to delete a trick
  Background:
    Given I load fixture file "fixtures.yml"
  Scenario: [Fail] trick not found
    And I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/delete/blabla"

  Scenario: [Success] delete a trick
    And I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/delete/backflip"
