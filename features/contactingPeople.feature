# features/healthcheck.feature

Feature: Contacting people is very important

  Interpreted literally

  Scenario: Show a contact's  job titles
    Given I request "/contact_roles?contact_id=1" using HTTP GET
    Then the response code is 200
    And the response body is:
    """
    [{
      id: 1
      title: "title1",
      phone: "123",
      active: true
    },
    {
      id: 2
      title: "title2",
      phone: "456",
      active: false
    }]
    """