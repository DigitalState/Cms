@api @metadata @delete
Feature: Delete metadata

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a metadata
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/metadata/176f6585-1420-49e0-a84c-9c84438fdbb4"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/176f6585-1420-49e0-a84c-9c84438fdbb4"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted metadata
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/metadata/176f6585-1420-49e0-a84c-9c84438fdbb4"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
