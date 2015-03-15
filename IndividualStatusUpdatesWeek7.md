# Individual Updates #
# Week of 5/8/2011 - 5/14/2011 #


---


**John Wang**

My goals from last week were:

  * Complete ConfirmAddBook? view, and work on FindBook?, and FindbookSearchResult? views for beta release.
  * Fix bugs with my controller and views.
  * Perform other “maintenance” tasks such as updating documentation as necessary.

This week I worked on the pages for the Add Books use case, and also worked on finding books for the beta release. Most of the add books and find books functionality is working properly, with the exception of some bugs and formatting, which I will try to fix this coming week. I also helped to update some of the SRS and User Documentation to reflect new developments in our application.

My goals for next week:

  * Fix bugs with add books and find books
  * Work on transactions use case
  * Update documentation as necessary
  * Do my user testing part of the beta evaluations


---

**Ken Inoue**

My goals from last week:

Complete the Library views and required functions in the controller
Get a better understanding of cakephp. Lack of understanding is slowing me down.

This week:
got the My book tab working and remove books up and running. Was not able to get change offer details working due to changing database scheme. Library didn't make it into the beta release due to a user error with version control

For Next Week:
This week I will be finishing the Library, mainly the loan and transaction tab as well as the change offer page. I will also help with the transaction view and redo the view for all library pages


---


**Troy Martin**


My goals from last week:

  * Finish my module for the beta release
  * Help the group get our beta release ready

This week I spent most of my time getting the facebooks login feature to work seamlessly with our application. This proved to be very difficult, because there was a setting wrong in our application setup. After this was figured out, the login worked properly. I also did the layouts for the application.

My goals for next week:

  * Help finish the completed release for Friday.
    * Specifically, help get the transactions module working
  * Tweak a lot of the applications visual features


---


**Wei-Ting Lu**

My goals from last week were:

  * Compile team status report (week 6) for turn in
  * Work with my teammates to finish the beta release. Try to support the dev and testers as much as I can
  * Rework SRS and SDS
  * Turn in Assignment 6

This week I turned in the team status report (week 6). I created a checklist of all the items that we'd like to get done for Beta release, and assigned task to the team and made sure they were on task. I worked on the SRS and SDS, and changed how some sections were presented to the user/dev. A problem I had was that I worked up until the last minute on Friday due to the fact I thought the assignment was due at 11:59pm Friday, when it was really due at 8:00pm. I need to learn how to better manage my time so I will be more help to my teammates. I worked with the Dev on getting some of the functionality working, especially the login part of our application. I hope I can work with both the Test and Devs to make sure everyone is on track.

My goals for next week are:
  * Compile team status report (week 7) for turn in
  * Evaluate LabEx's application (using Dev Documentation)
  * Work on Feature Complete Release, with a requirements checklist
  * Update SRS, SDS, User Doc, Dev Doc as changes occur
  * Assist the Devs and Tests if they need help



---


**James Parsons**

My Goals From Last Week:
  * Complete book initial offer and styling of pages to help match our UI design.
  * Work with Jedidiah to update our SRS document for the Beta Release Assignment.
  * Begin work on implementing the views and controller for the "Transaction" use case.

Last week I was able to complete the functionality for the book initial offers pages. I also spent a large amount of time working with Troy to help integrate Facebook login and authentication seamlessly into our app. We were successful, and our app now correctly prompts the user to give it data priveleges, and checks if the user is logged in and redirects accordingly.

For Next Week:
  * Complete user beta review for LabEX with John, Tatsuro, and Ken
  * Complete Transactions functionality for Friday release.
  * Keep documentation up to date as changes are made.



---


**Jedidiah Jonathan**

My goals for last week are:

  * Implement the Unit Testes for one controller (Book\_initial\_offet\_controller)
  * Update the SRS live document.

My Tests were ready for the Beta Release, although they had to be updated a lot on the day of the release as the developers made some changes to the function signatures that caused the test to fail. A major issue with the new implementation was the developers were reading the session user\_id from the facebook page and my tests at that point were not ready to accept a valid session, so the tests results in simple NULL assertions. I even worked on parts of the SRS, based on the checklist that were set by the Team PM. For the coming week, I would love to collaborate a lot more on ideas of testing with the other testors and shoot for really good coverage on all our test code. The tests need to be updated as the developers intend to add more functionality and all the features.

My goals for the next week are:

  * Update the Book\_initial\_offer\_controller test
  * Test Documentation
  * Work with other testors to perform test code reviews.


---


**Greg Brandt**

My goals from last week were to
  * Implement the majority of the Transaction unit test
  * Implement Add Books use case system test

I implemented the accept and counter tests for the Transaction unit test, which leaves testing my\_transaction (which aggregates all of a given user's transactions). I also implemented the Add Books use case test. This test ignores the login aspect of the application, but is complete otherwise for the use case.

My goals for next week are to
  * Write the Exchange Books use case test
  * Write the View My Library use case test
  * Finish the Transaction unit test


---

**Tatsuro Oya**

My goals from last week are:

  * Learn unit testing on CakePHP
  * Complete unit test for BookController
  * post Bug Report

This week I mainly worked on testing unit test for BookController module. There were so many restrictions and not so many examples that I can take a look for controller test in  CakePHP. Therefore we discussed thoroughly what we can do for our testing in team and I also updated some diagrams in SDS.

My goals for next week:
  * Finish unit testing and other testing if necessary
  * Update documentation
  * Finish labEX's user test with other team member.