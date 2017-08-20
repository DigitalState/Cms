@entity @data @delete
Feature: Delete datas
  In order to delete datas
  As an admin identity
  I should be able to send api requests related to datas

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete a category
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/datas/0bdc078a-4d24-4719-b00d-6342dd52e0d5"
    Then the response status code should be 204
    And the response should be empty
