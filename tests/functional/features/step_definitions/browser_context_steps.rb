Given /^that a "([^"]*)" is logged in as "([^"]*)", "([^"]*)"$/ do |user_type, email, password|
  Capybara.session_name = user_type

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
  find('#form-for-questions input[type="submit"]').click
end

Then /^he sees a list of available tutors$/ do
  page.text.should include 'Choose'
  page.text.should include 'online tutors below. Then click here to connect'
end

When /^the student pick an available tutor$/ do
  check 'checkbox[1619]'
  click_link 'submit_connect'
end

Then /^the "([^"]*)" sees "([^"]*)"$/ do |user_type, message|
  Capybara.session_name = user_type
  page.text.should include message
end

Then /^the "([^"]*)" sees a notification window$/ do |user_type|
  Capybara.session_name = user_type

  page.has_selector? '#MB_window'
  find('#MB_window').text.should include 'this question expires'
  find('#MB_window').text.should include 'Connect'
end

