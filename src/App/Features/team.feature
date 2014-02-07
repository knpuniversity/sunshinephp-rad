Feature: Team management
  In order to view and control which teams are in the system
  As an admin
  I need to be able to add/edit/delete teams

  Scenario: Listing teams
    Given there are 5 teams
    And I am on "/"
    When I click "Teams"
    Then I should see 5 rows in the table
