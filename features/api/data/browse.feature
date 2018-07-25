@api @data @browse
Feature: Browse datas
  In order to browse datas
  As a system identity
  I should be able to send api requests related to datas

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Browse all datas
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse paginated datas
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?uuid=68c28209-cad4-43ac-9f76-fb1791d672da"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?uuid[0]=68c28209-cad4-43ac-9f76-fb1791d672da"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?ownerUuid=e51aea66-ba28-4718-9644-e5fc35ad7a45"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?ownerUuid[0]=e51aea66-ba28-4718-9644-e5fc35ad7a45"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas that has keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?title=Pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas that has case-insensitive keywords for title
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?title=pothole"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse datas ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  @dropSchema
  Scenario: Browse datas ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/datas?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

#  Scenario: Browse datas ordered by title asc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/datas?order[title]=asc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

#  Scenario: Browse datas ordered by title desc
#    When I add "Accept" header equal to "application/json"
#    And I send a "GET" request to "/datas?order[title]=desc"
#    Then the response status code should be 200
#    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
#    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items
