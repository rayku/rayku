Feature: Signing up & in
  Scenario: Signing up
    Given that I'm connecting to Rayku
    And I'm a new user
    When I register on it as "John Doe", "john.doe@nobodies.com"
    Then I should see a "We are currently in a closed private beta." message on the page
