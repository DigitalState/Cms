@api @access @read
Feature: Read accesses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Read a service
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses/843912b3-c49d-46fe-a11c-c21e04ee2ded"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "843912b3-c49d-46fe-a11c-c21e04ee2ded"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    And the JSON node "assignee" should exist
    And the JSON node "assignee" should be equal to the string "Anonymous"
    And the JSON node "assigneeUuid" should exist
    And the JSON node "assigneeUuid" should be null
    And the JSON node "permissions" should exist
    And the JSON node "permissions" should have 0 elements
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
