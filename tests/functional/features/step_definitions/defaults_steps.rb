Given /^that I'm connecting to Rayku$/ do
  visit '/'
end

Then /^I should see a "([^"]*)" message on the page$/ do |text|
  page.text.should include text
end
