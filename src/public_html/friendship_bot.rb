#!/usr/bin/ruby

require 'rubygems'
require 'mechanize'

class FriendshipBot

  #generates facebook phstamp
  #converted from javascript to ruby 
  #credits : http://www.blackhatworld.com/blackhat-seo/facebook/411272-cracked-facebooks-phstamp.html
  #by StellaArtois
  def generatePhstamp(qs, dtsg)

  	input_len = qs.length
  	numeric_csrf_value = '';

  	for i in 0..dtsg.length-1
  		c = dtsg[i]
  		numeric_csrf_value += "#{c}"
  	end
  	@phstamp = "1" + numeric_csrf_value + String(input_len)
  end

  
  def accept_friends username, password
    @agent = Mechanize.new
    requests_page = login(username, password)
    friendship_requests = requests_page.forms_with(:action => '/ajax/reqs.php')
    
    friendship_requests.each do |request|

      #grab a handle to the pertinent submit button
      submit = request.button_with(:name => 'actions[accept]')

      #prep string for query 
	    qs = ""

      #add missing fields
      request.add_field!("__user", value = 100002301139037)
      request.add_field!("__a", value = 1) 

      # create the query string
	    request.fields.each { |f| 
  	  	name = CGI::escape(f.name)
  	  	value = CGI::escape(String(f.value))
  	  	qs += "#{name}=#{value}"
      }

      #grab facebook dtsg value 
      fb_dtsg = request['fb_dtsg']

      generatePhstamp qs,fb_dtsg

      request.add_field!("phstamp", value = @phstamp) 

      #submit the form 
      request.click_button(submit)
      
    end
  end

  private
  def login(username, password)
    page = @agent.get('http://facebook.com/reqs.php')
    form = page.form_with :id => 'login_form'

    form.email = username
    form.pass = password

    form.submit
  end
  
end

#execute script 
puts "creating bot"
bot = FriendshipBot.new
puts "accepting friends"
bot.accept_friends "raykubot@rayku.com", "bghtyu123"