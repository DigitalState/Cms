@api @security @tenant @data
Feature: Deny access to data belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse data from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/data"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "items": {
        "type": "object",
        "properties": {
          "tenant": {
            "type": "string",
            "pattern": "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
          }
        }
      },
      "required": [
        "tenant"
      ]
    }
    """

  Scenario: Read a data from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/data/4e10797a-502c-406b-b03b-bc65c3466c23"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a data from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/data/4e10797a-502c-406b-b03b-bc65c3466c23" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a data from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/data/4e10797a-502c-406b-b03b-bc65c3466c23"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
