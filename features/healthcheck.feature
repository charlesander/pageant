# features/healthcheck.feature

Feature: To ensure the API is up and running

  Test that the API is at least up

  Scenario: Simple healthcheck
    Given I request "/ping" using HTTP GET
    Then the response code is 200
    And the response body is:
    """
    "pong"
    """