@security
@security_register

Feature: As a anonymous user
  Background:
    Given I am on "/register"

  Scenario: [Fail] submit form without data
    Then I should be on "/register"

  Scenario: [Fail] submit form with bad email
    When I fill in "Prenom" with "romain"
    And I fill in "Pseudo" with "romain"
    And I fill in "Nom" with "romain"
    And I fill in "Mail" with "bestemail"
    And I fill in "mot de passe" with "TestK@4578@"
    And I fill in "Confirmer le mot de passe" with "TestK@4578@"
    Then I should see "Le champ mail n'est pas correct"

  Scenario: [Fail] submit form with a bad password
    When I fill in "Prenom" with "romain"
    And I fill in "Pseudo" with "romain"
    And I fill in "Nom" with "romain"
    And I fill in "Mail" with "bestemail@gmail.com"
    And I fill in "mot de passe" with "Test"
    And I fill in "Confirmer le mot de passe" with "Test"
    And I fill in "File" with "fwfiweoi.png"
    And I fill in "Legend" with "legend"
    And I press "Envoyer"
    Then I should see "Votre mot de passe doit contenir une lettre majuscule, une lettre minuscule, un caractère spéciale '!@%$&*', et un chiffre, 8 caractères minimum"

  Scenario: [Success] submit form with good datas
    When I fill in "Pseudo" with "test"
    And I fill in "Mail" with "bestemail@gmail.com"
    And I fill in "Prenom" with "test"
    And I fill in "Nom" with "test"
    And I fill in "mot de passe" with "TestK@4578@"
    And I fill in "Confirmer le mot de passe" with "TestK@4578@"
    And I fill in "File" with "fwfiweoi.png"
    And I fill in "Legend" with "legend"
    And I press "Envoyer"
    Then I should see "un mail de confirmation a été envoyé"
    And User "test" should be exist into database