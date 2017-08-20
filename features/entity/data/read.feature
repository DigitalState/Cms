@entity @data @read
Feature: Read datas
  In order to read datas
  As an admin identity
  I should be able to send api requests related to datas

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Read a category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas/0bdc078a-4d24-4719-b00d-6342dd52e0d5"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "0bdc078a-4d24-4719-b00d-6342dd52e0d5"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "a8357843-470d-4e3a-8014-5fec0306e017"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "road-classifications"
    And the JSON node "title" should exist
#    And the JSON node "title" should be equal to "todo"
    And the JSON node "data" should exist
#    And the JSON node "data" should be equal to "todo"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
