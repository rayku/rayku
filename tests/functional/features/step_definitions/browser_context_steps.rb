Given /^that a "([^"]*)" is logged in as "([^"]*)", "([^"]*)"$/ do |user_type, email, password|
  switch_to(user_type)

  step %{that I'm connecting to Rayku}
  step %{I'm a registered user}
  step %{I sign in as "#{email}", "#{password}"}
end

Given /^is available for tutoring$/ do
end

Given /^the student posts a question$/ do
  fill_in 'question', :with => "What's the meaning of life?"
  find('div.sbHolder a.sbSelector').click
  find(:xpath, "//div[@class='sbHolder']//a[contains(text(), 'Algebra')]").click
  wait_until { not find('#form-for-questions input[type="submit"]').nil? }
  find('#form-for-questions input[type="submit"]').click
end

Then /^he sees a list of available tutors$/ do
  page.text.should include 'Choose'
  page.text.should include 'online tutors below. Then click here to connect'
end

When /^the student pick an available tutor$/ do
  check 'checkbox_1619'
  click_link 'submit_connect'
end

Then /^the "([^"]*)" sees "([^"]*)"$/ do |user_type, message|
  Capybara.session_name = user_type
  page.text.should include message
end

Then /^the tutor sees a notification window$/ do
  Capybara.session_name = 'tutor'

  wait_until { page.has_selector? '#MB_window' }
  find('#MB_window').text.should include 'this question expires'
  find('#MB_window').text.should include 'Connect'
end

Given /^that a tutor is logged in$/ do
  step %{that a "tutor" is logged in as "donny@rayku.com", "linan45445"}
  step %{is available for tutoring}
end

Given /^that a student is logged in$/ do
  step %{that a "student" is logged in as "g@rayku.com", "devpass45445"}
end

When /^pick the available tutor$/ do
  step %{the student pick an available tutor}
end

Then /^the tutor accepts the question$/ do
  Capybara.session_name = 'tutor'
  find('a.MB_focusable').click
end

Then /^the "([^"]*)" will be redirected to the whiteboard$/ do |user_type|
  Capybara.session_name = user_type
  wait_until { page.has_content? '45 minutes left' }
  page.driver.browser.title.should == 'Rayku - Whiteboard'
end

