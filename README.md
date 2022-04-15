# RT Camp Assignment

## Problem Statement

   **Please create a simple PHP application that accepts a visitor’s email address and emails them random XKCD comics every five minutes.**

   1. Your app should include email verification to avoid people using others’ email addresses.
   2. XKCD image should go as an email attachment as well as inline image content.
   3. You can visit [XKCD](https://c.xkcd.com/random/comic/) programmatically to return a random comic URL and then use JSON API for details [XKCD API](https://xkcd.com/json.html)
   4. Please make sure your emails contain an unsubscribe link so a user can stop getting emails. 

## Approach to solve this problem
# My Solution @ [Janak Patel's Solution](https://janak-patel-rtc-assignment.herokuapp.com/)
### Services used for this project
   - [Heroku](https://www.heroku.com/)
     * For free hosting service 
   - [Sendgrid](https://sendgrid.com/)
     * For Free Mail Services
   - [Remote MySQL](https://remotemysql.com/)
	 * For Free MySQL Database
   - [Cron-job](https://cron-job.org/en/)
	 * For Free Cron-job

  ### Must needed files
   - Landing Page
   - database
   - Helper file (containing functions to make main files look clear and to give modularity)
   - Crone process file

  ### Files Created and Structure of the Project

- .git
- .github
- .vscode
- partials
	- _dbConnect.php---------------------------------# database connection config
	- _helpers.php-------------------------------------# all helping functions are define here
	- _mailVerifier.php---------------------------------# Helper file with function and mail structure
- private
	- _API_KEYS.php-----------------------------------# Secrete passwords and API keys
- public
	- Assets
		- fonts
			- sammyFont.woff2----------------------# for custom fonts
		- Images
			- 3806193.jpg----------------------------# Image file
			- circuit_diagram.png--------------------# Image file
			- sad.png---------------------------------# Image file
			- self_description.png--------------------# Image file
			- strip_games.png------------------------# Image file
		- Logos
			- exclamation-triangle-solid.svg---------# logo or favicon
			- image2vector.svg-----------------------# logo or favicon
			- RTC-logo.jpg----------------------------# logo or favicon
			- RTC-logo.png---------------------------# logo or favicon
		- _mailSender.php--------------------------# php File that is responsible for sending mails to subscribers
		- Bad.html-----------------------------------# For bad requests

		- ByeBye.html-------------------------------# Unsubscribe good bye page
		- index.php----------------------------------# Landing Page
		- phpcs.xml----------------------------------# phpcs xml file
		- StyleSheet.css------------------------------# CSS File
		- Thankyou.html-----------------------------# After mail varification
		- unsubscribe.php---------------------------# unsubcribe script
		- validator.php-------------------------------# initial mail verifier
- composer.json----------------------------------------# blank file(required at heroku)
- Procfile------------------------------------------------# engine config and root directory defines here  
-  README.md------------------------------------------# I don't know


### Process to configure HEROKU
Step 1: Create free account on Heroku
step 2: Setup new app by just entering unique name
step 3: Install Heroku CLI app on your PC
step 4: Create a blank folder
step 5: create "composer.json" a blank file
step 6: create/copy folders according to your structure
step 7: start git, do staging make commits
step 8: if you have landing page inside a folder configure Procfile
			- to do so follow below steps:
				- create a file with name "Procfile" without any extension
				- add following single quoted line in it 
					- 'web: vendor/bin/heroku-php-apache2 public/' where last word ie public/ shows location of landing page
step 8: on command prompt type following codes
```
	- heroku login
	- heroku git:remote -a YOUR_APP_NAME_HERE
	- git push heroku main(if branch name is main else)
	- git push heroku master:main(if branch name is master else replace master with your branch name)
``` 
step 9: Done..
This are very rief steps but enough for hosting a project one can always refers official documents

### For cron job 
- just create your free account 
- go to cronjob tab
- add a path of your php file which you want to execute at certain interval (note: put that file in public folder so that cronjob can have access)
- configure cron job settings according to your need

### For remote MySQL
- Create free account at remotemysql.com
- go to DATABASES scroll down and click on create new Database
- configure your database once it done, set name passwords etc to dbConnect file in partials
- and Done..
	
# My Solution @ [Janak Patel's Solution](https://janak-patel-rtc-assignment.herokuapp.com/)
## thank you