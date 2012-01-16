When /^I register on it as "([^"]*)", "([^"]*)"$/ do |name, email|
  within('#registration-form') do
    find('.name').set(name)
    find('.email').set(email)

    find('input[type="submit"]').click
  end
end

Then /^I should see a "([^"]*)" message on the page$/ do |text|
  page.text.should include text
end
