@api @data @read
Feature: Read datas
  In order to read datas
  As a system identity
  I should be able to send api requests related to datas

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures @dropSchema
  Scenario: Read a category
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas/68c28209-cad4-43ac-9f76-fb1791d672da"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "68c28209-cad4-43ac-9f76-fb1791d672da"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "e51aea66-ba28-4718-9644-e5fc35ad7a45"
    And the JSON node "slug" should exist
    And the JSON node "slug" should be equal to the string "road-classifications"
    And the JSON node "title" should exist
    And the JSON node "title.en" should exist
    And the JSON node "title.en" should be equal to "Road Classifications"
    And the JSON node "title.fr" should exist
    And the JSON node "title.fr" should be equal to "Classifications routières"
    And the JSON node "data" should exist
    And the JSON node "data.en" should exist
    And the JSON node "data.en.city-freeway" should exist
    And the JSON node "data.en.city-freeway" should be equal to "City Freeway"
    And the JSON node "data.fr" should exist
    And the JSON node "data.fr.city-freeway" should exist
    And the JSON node "data.fr.city-freeway" should be equal to "Autoroute de ville"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
