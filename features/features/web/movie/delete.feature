@web
@web_delete_movie

Feature: As an authenticated user,  I want delete a movie
  Background:
    Given I load fixture file "fixtures.yml"
  Scenario: [Succes] delete movie
    Then I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/delete/movie/f844c4d4-4b28-490c-b460-3915152f2802"

  