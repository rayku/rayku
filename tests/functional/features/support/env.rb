require "rubygems"
require "bundler"
Bundler.setup(:default)
Bundler.require

module Capybara::Config
  include Capybara::DSL
  Capybara.run_server = false
  Capybara.ignore_hidden_elements = true
  Capybara.default_driver = :selenium
  Capybara.default_wait_time = 15
  Capybara.app_host = 'http://' + (ENV['HOST'] || "rayku.localhost")

end

def switch_to(user)
  Capybara.session_name = user
  page.execute_script('window.focus()')
end

Capybara.register_driver :selenium do |app|
  Capybara::Selenium::Driver.new(app, :browser => :chrome)
end
