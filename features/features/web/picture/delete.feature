@web
@web_delete_picture

Feature: As an authenticated user,  I want delete a movie
  Background:
    Given I load fixture file "fixtures.yml"
  Scenario: [Succes] delete movie
    Then I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/delete/picture/1dfa19c7-edc8-499e-bc1f-6c5548c2adfd"