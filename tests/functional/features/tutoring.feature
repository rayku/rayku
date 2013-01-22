Feature: Student and tutor connection
  Scenario: Student posts a question and tutor is notified
    Given that a "tutor" is logged in as "donny@rayku.com", "linan45445"
    And is available for tutoring

    Given that a "student" is logged in as "g@rayku.com", "devpass45445"

    When the student posts a question
    Then he sees a list of available tutors

    When the student pick an available tutor
    Then the "student" sees "Notifying Tutors Now"
    And the tutor sees a notification window

  Scenario: Student posts a question and tutor accepts it
    Given that a tutor is logged in
    And that a student is logged in

    When the student posts a question
    And pick the available tutor

    When the tutor accepts the question

    Then the "tutor" will be redirected to the whiteboard
    And the "student" will be redirected to the whiteboard



