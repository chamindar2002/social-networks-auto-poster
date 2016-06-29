|------------------------------------------------------|
|                                                      |
|Installation                                          |
|                                                      |
|------------------------------------------------------|
1.Pull the code to your web directory
2.Cd into packages/media/publish/ directory and run composer install command to install dependency packages
3.Alter the text assigned to $messageToPublish varialble (this is the text that would go on to you facebook time line) in the index.php file in the root directory
4.Open browser and go to http://<host>/<director>index.php
5.A JSON response will be given

note: to execute the cron command for testing cd into root directory and run > php cron.php

|------------------------------------------------------|
|                                                      |
|Overview                                              |
|                                                      |
|------------------------------------------------------|

Due to my work load with project tasks at my current office to meet the deadlines these days I couldn't afford too much
time on this task. However with the the available time I managed to get the task done up to a substantial(not fully satisfied my self)
level that would do the publishing on facebook timeline.


|------------------------------------------------------|
|                                                      |
|Objective                                             |
|                                                      |
|------------------------------------------------------|

The primary objective is to post and schedule text to social media

|------------------------------------------------------|
|                                                      |
|Main considerations                                   |
|                                                      |
|------------------------------------------------------|

In order to make api calls on be half of a user to social media such as twitter and facebook, an access token is required.
To get this token from facebook we need to send a request with necessary permissions with a redirect link attached.
If the user signs in and authorize successfully it will redirect the user with the access token.

To schedule a post we cannot follow this procedure as it would be an offline procedure. Therefore I had to fetch the token offline
and hard code in the init() method of the publisher class.

|------------------------------------------------------|
|                                                      |
|Assumptions                                           |
|                                                      |
|------------------------------------------------------|

The main assumption that had to be made was scheduling the post. Finally reverted the task to be handled by a cron job.


|------------------------------------------------------|
|                                                      |
|File structure                                        |
|                                                      |
|------------------------------------------------------|

The FacebookPublisher class is bundled as a package and will throw a JSON response after handling the publish() method.
The consideration was that this would be easily integrated with an api route with RESTful implementation or generic html or AJAX request.

index.php file is used to trigger the publish() method in the FacebookPublisher class.
cron.php file is used to schedule posts. A crontab entry will have to be run every 24 hours to execute the cron.php.

The FacebookPublisherContract abstract class is used as the super class with constructor implementation.
Facebook app is initialized in the constructor. The constructor will trigger the init() method of all the children.
This will help the child class to do the necessary variable initialization to be handled.

The exception handler is also declared in the FacebookPublisherContract class to make sure all derived classes will not overide the exception
handler (declared as final). This was done to enforce the exceptions to be handled in one single point.

Suppose a requirement comes up to handle image uploads the same FacebookPublisherContract class could be used as the super class.

|------------------------------------------------------|
|                                                      |
|What's to be done next and further enhancements       |
|                                                      |
|------------------------------------------------------|

Implement other social media publishing modules following the same file architecture.
Implement a clean ui interface to make this package more user friendly.
Enable multiple publishing to selected media accounts in one go.









