# features/healthcheck.feature

Feature: We want to track the history of a person’s jobs

  History and current jobs will be stored in the organisation_contact table, and a current job will be deduced from the new fields active_from and active_to. Current jobs will be identified as a record having the active_to column being in the future or null.

  Scenario: Get history of a person's jobs
    Given I request "/organisation_role/?contact_id=1" using HTTP GET
    Then the response code is 200
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