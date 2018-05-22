@app @api @entity @data @add
Feature: Add datas
  In order to add datas
  As a system identity
  I should be able to send api requests related to datas

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Add a data
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/datas" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "e51aea66-ba28-4718-9644-e5fc35ad7a45",
      "slug": "data-1",
      "title": {
        "en": "Title - add",
        "fr": "Titre - add"
      },
      "data": {
        "en": {
          "test": "Test - add"
        },
        "fr": {
          "test": "Test - add"
        }
      },
      "version": 1
    }
    """
    Then the response status code should be 201
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 3
    And the JSON node "uuid" should exist
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "e51aea66-ba28-4718-9644-e5fc35ad7a45"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "data-1"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Title - add"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Titre - add"
    And the JSON node "data" should exist
    And the JSON node "data.en" should exist
    And the JSON node "data.en.test" should exist
    And the JSON node "data.en.test" should be equal to "Test - add"
    And the JSON node "data.fr" should exist
    And the JSON node "data.fr.test" should exist
    And the JSON node "data.fr.test" should be equal to "Test - add"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @dropSchema
  Scenario: Read the added data
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?id=3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
