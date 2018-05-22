@app @api @entity @data @delete
Feature: Delete datas
  In order to delete datas
  As a system identity
  I should be able to send api requests related to datas

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Delete a data
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/datas/68c28209-cad4-43ac-9f76-fb1791d672da"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted data
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas/68c28209-cad4-43ac-9f76-fb1791d672da"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @dropSchema
  Scenario: Delete a deleted data
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas/68c28209-cad4-43ac-9f76-fb1791d672da"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
