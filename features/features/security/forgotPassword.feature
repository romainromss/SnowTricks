@security
@security_forgot_password
Feature: As an authenticated user, I want change my lost password
  Background:
    Given I am on "/forgot"
    And I load fixture file "fixtures.yml"
  Scenario: [Fail] I submit without data
    Then I should be on "/forgot"
  Scenario: [Fail] I submit with bad datas
    When I fill in "E-mail" with "bestemail@gmail.com"
    And I fill in "Pseudo" with "test"
    And I press "Envoyer"
    And I should see "mauvais pseudo ou email"
    And I should be on "/forgot"
  Scenario: [Success] I submit with good data
    When I fill in "E-mail" with "test@gmail.com"
    And I fill in "Pseudo" with "test"
    And I press "Envoyer"
    And I should see "un mail de réinitialisation a été envoyé"
    And I should be on "/"
  Scenario: [Fail] I'm login with bad token
    Then I am on "/forgot/password/token"
    And I should be on "/"
    And I should see "error.tokenNotFound"
  Scenario: [Fail] I'm login with bad data
    Given I define resetPasswordToken to user test@gmail.com/test
    Then I am on "/forgot/password/testToken"
    And I fill in "validate_forgot_password_password_first" with "12345678"
    And I fill in "Confirmer le mot de passe" with "12345678"
    And I press "Envoyer"
    And I should see "Votre mot de passe doit contenir une lettre majuscule, une lettre minuscule, un caractère spéciale '!@#%$&*', et un chiffre, 8 caractères minimum"
  Scenario: [Success] I'm login with good token
    Given I define resetPasswordToken to user test@gmail.com/test
    And I am on "/forgot/password/testToken"
    And I fill in "validate_forgot_password_password_first" with "TestA@4467@"
    And I fill in "Confirmer le mot de passe" with "TestA@4467@"
    And I press "Envoyer"
    And I should be on "/"
    And I should see "le mot de passe a été réinitialisé"