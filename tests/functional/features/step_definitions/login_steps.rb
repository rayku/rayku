When /^I register on it as "([^"]*)", "([^"]*)"$/ do |name, email|
  within('#registration-form') do
    find('.name').set(name)
    find('.email').set(email)

    find('input[type="submit"]').click
  end
end

Given /^I'm a new user$/ do
end

Given /^I'm a registered user$/ do
end

Given /^I'm not a registered user$/ do
end

When /^I (try to )?sign in as "([^"]*)", "([^"]*)"$/ do |ignore, email, password|
  find('#login-tab').click
  within('#login-form') do
    find('.email').set(email)
    find('.password').set(password)

    find('input[type="submit"]').click
  end
end

Then /^I should be redirected to my dashboard$/ do
  wait_until { page.text.match /Ask a Question/ }
end

Given /^that a "([^"]*)" is logged in as "([^"]*)", "([^"]*)"$/ do |user_type, email, password|
  switch_to(user_type)

  step %{that I'm connecting to Rayku}
  step %{I'm a registered user}
  step %{I sign in as "#{email}", "#{password}"}
end
