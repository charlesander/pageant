# features/healthcheck.feature

Feature: Not all people are active

  I have interpreted this as meaning "Not all people's ROLES are active"
  Scenario: Get a contact's roles, both active and inactive
    Given I request "/organisation_role/?contact_id=2" using HTTP GET
    Then the response code is 202
    And the response body is:
    """
    [
      {
        id: 1,
        name: "Title 1",
        organisation: "Organisation 1",
        startDate: "2019-01-02",
        endDate: null,
        active: false
      },
      {
        id: 2,
        name: "Title 2",
        organisation: "Organisation 2",
        startDate: "2018-01-01",
        endDate: 2019-01-01,
        active: true
      }
    ]
    """
  Scenario: Get a contact with only active roles
    Given I request "/organisation_role/?contact_id=3" using HTTP GET
    Then the response code is 202
    And the response body is:
    """
    [
      {
        id: 3,
        name: "Title 2",
        organisation: "Organisation 2",
        startDate: "2018-01-01",
        endDate: 2019-01-01,
        active: true
      }
    ]
    """
  Scenario: Get a contact with only inactive roles
    Given I request "/organisation_role/?contact_id=4" using HTTP GET
    Then the response code is 202
    And the response body is:
    """
    [
      {
        id: 4,
        name: "Title 1",
        organisation: "Organisation 1",
        startDate: "2019-01-02",
        endDate: null,
        active: false
      }
    ]
    """