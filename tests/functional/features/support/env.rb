require "rubygems"
require "bundler"
Bundler.setup(:default)
Bundler.require

module Capybara::Config
  include Capybara::DSL
  Capybara.run_server = false
  Capybara.ignore_hidden_elements = true
  Capybara.default_driver = :selenium
  Capybara.default_wait_time = 10
  Capybara.app_host = 'http://' + (ENV['HOST'] || "rayku.localhost")
end

Capybara.register_driver :selenium do |app|
  Capybara::Selenium::Driver.new(app, :browser => :chrome)
end

#Spec::Runner.configure do |config|
#  config.include(Capybara::Config)
#end
