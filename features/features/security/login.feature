@security
@security_login
Feature: As an authenticated user,  I want be connected
  Background:
    Given I load fixture file "fixtures.yml"
  Scenario: [Fail] submit with no data
    Then I should be on "/"
  Scenario: [Success] Submit with good datas and user exist in database
    And I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database