@web_tricks

Feature: As an authenticated user,  I want to create a trick
  Background:
    Given I load fixture file "fixtures.yml"
#  Scenario: [Fail] submit with no data
#  Scenario: [Fail] submit without token
#  Scenario: [Fail] submit with invalid token
  Scenario: [Success] create a trick
    Given I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"