Feature: Signing up & in
  Scenario: Signing up
    Given that I'm connecting to Rayku
    And I'm a new user
    When I register on it as "John Doe", "john.doe@nobodies.com"
    Then I should see a "We are currently in a closed private beta." message on the page

  Scenario: Signing in
    Given that I'm connecting to Rayku
    And I'm a registered user
    When I sign in as "g@rayku.com", "devpass45445"
    Then I should see a "You are now logged in." message on the page
    And I should be redirected to my dashboard

  Scenario: Signing in with an invalid email
    Given that I'm connecting to Rayku
    And I'm not a registered user
    When I try to sign in as "non-existent@nobodies.com", "mypassword"
    Then I should see a "Your username or password was incorrect." message on the page

  Scenario: Signing in with an invalid password
    Given that I'm connecting to Rayku
    And I'm a registered user
    When I try to sign in as "kinkarso@gmail.com", "ivalidpassword"
    Then I should see a "Your username or password was incorrect." message on the page
