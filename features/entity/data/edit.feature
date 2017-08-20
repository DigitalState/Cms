@entity @data @edit
Feature: Edit datas
  In order to edit datas
  As an admin identity
  I should be able to send api requests related to datas

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Edit a data
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/datas/0bdc078a-4d24-4719-b00d-6342dd52e0d5" with body:
    """
    {
      "ownerUuid": "7b4f7178-da07-4004-8475-cdd120e26d2d",
      "slug": "data-1-edit",
      "title": {
        "en": "Title - edit",
        "fr": "Title - edit"
      },
      "data": {
        "en": {
          "test": "Test - edit"
        },
        "fr": {
          "test": "Test - edit"
        }
      }
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "7b4f7178-da07-4004-8475-cdd120e26d2d"
    And the JSON node "slug" should be equal to the string "data-1-edit"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"

  Scenario: Confirm the edited data
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas/0bdc078a-4d24-4719-b00d-6342dd52e0d5"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "7b4f7178-da07-4004-8475-cdd120e26d2d"
#    And the JSON node "title" should be equal to "todo"
#    And the JSON node "data" should be equal to "todo"

  Scenario: Edit a data's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/datas/0bdc078a-4d24-4719-b00d-6342dd52e0d5" with body:
    """
    {
      "id": 9999,
      "uuid": "40a0f921-18ac-4d94-b08d-ea647be20ae1",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "0bdc078a-4d24-4719-b00d-6342dd52e0d5"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited data
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas/0bdc078a-4d24-4719-b00d-6342dd52e0d5"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "0bdc078a-4d24-4719-b00d-6342dd52e0d5"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a data with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/datas/0bdc078a-4d24-4719-b00d-6342dd52e0d5" with body:
    """
    {
      "slug": "road-classifications-edit",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
