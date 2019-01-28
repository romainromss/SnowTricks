@web
@web_trick

Feature: As an authenticated user,  I want to create a trick
  Background:
    Given I load fixture file "fixtures.yml"
  Scenario: [Fail] submit with no data
    Then I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/add/trick"
    And I press "Envoyer"
    And I should see "Veuillez compléter ce champ"
  Scenario: [Fail] submit without picture
    Then I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/add/trick"
    And I fill in "Name" with "trick 1"
    And I fill in "Description" with "description 1"
    And I fill in "Category" with "grab"
    And I press "Envoyer"
    And I should see "Veuillez compléter ce champ"
  Scenario: [Fail] submit without movie
    Then I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/add/trick"
    And I fill in "Name" with "trick 1"
    And I fill in "Description" with "description 1"
    And I fill in "Category" with "grab"
    And I fill in "add_trick_pictures_0_file" with "1b6f6cc1a7a5e801b705d46688ddefa3.jpeg"
    And I fill in "add_trick_pictures_0_legend" with "legend"
    And I press "Envoyer"
    And I should see "Veuillez compléter ce champ"
  Scenario: [Success] create a trick
    And I am on "/login"
    When I fill in "pseudo" with "romain"
    And I fill in "Mot de passe" with "TestA@4567@"
    And I press "Envoyer"
    And User "romain" should be exist into database
    And I am on "/add/trick"
    And I fill in "Name" with "trick 1"
    And I fill in "Description" with "description 1"
    And I fill in "Category" with "grab"
    And I fill in "add_trick_pictures_0_file" with "1b6f6cc1a7a5e801b705d46688ddefa3.jpeg"
    And I fill in "add_trick_pictures_0_legend" with "legend"
    And I fill in "Embed" with "embed"
    And I fill in "Legend" with "legend"
    And I press "Envoyer"
