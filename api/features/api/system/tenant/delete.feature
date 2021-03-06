@api @system @tenant @delete
Feature: Delete tenants

  Background:
    Given I am authenticated as the "system" user

  Scenario: Delete a tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/system/tenants/92000deb-b847-4838-915c-b95d2b28e960"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/system/tenants/92000deb-b847-4838-915c-b95d2b28e960"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
