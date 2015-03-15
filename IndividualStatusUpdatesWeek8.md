# Individual Updates #
# Week of 5/15/2011 - 5/21/2011 #


---


**John Wang**

My goals from last week were:
  * Fix bugs with add books and find books
  * Work on transactions use case
  * Update documentation as necessary
  * Do my user testing part of the beta evaluations

This week I helped write the code for the transactions view and controller. I also touched up the UI and the code for the add books and find books controller. The testers brought up an important point this week regarding adherence to MVC. As such, I had to go back and change some code to follow this adherence. This was also important in allowing the testers' test code to work. As such, the biggest lesson I learned this week was to make sure to keep in contact with testers to know of their needs, and to make sure to stay in adherence to the architecture that we choose.

  * Touch up and add more comments my code.
  * Recruit a user to do user testing.
  * Participate in code reviews; review a tester's code


---


**Ken Inoue**
Gaols from last week. I will be finishing the Library, mainly the loan and transaction tab as well as the change offer page. I will also help with the transaction view and redo the view for all library pages

This week I helped finish my Library by completing the change offer functionality and page as well as fixing up my Library so it looked more professional. I also had to fix some code so the testers could properly test the code. I was supposed to work on the my loans and transactions pages but due to other projects I was only able to help finish them after much of the base work had already been done on them.

Next week I will spend doing the following:
  * Help Find testers
  * Comment my code more clearly and clean it up.
  * help with the code reviews



---


**Troy Martin**

My goals from last week:

  * Help finish the completed release for Friday.
    * Specifically, help get the transactions module working
  * Tweak a lot of the applications visual features

This week I worked on getting the feature complete release done. Specifically, I implemented the myLoans functionality, the ability to delete completed transactions, and cleaned up the css to make the overall appearance of our app more pleasant. The rest of my time was spent fixing bugs. These were uncovered as we ran through use cases.

My goals for next week:

  * Make changes to our application based on usability testing feedback.
  * Continue to correct bugs for our release candidate due Friday.


---


**Wei-Ting Lu**
My goals from last week were:
  * Compile team status report (week 7) for turn in
  * Evaluate LabEx's application (using Dev Documentation)
  * Work on Feature Complete Release, with a requirements checklist
  * Update SRS, SDS, User Doc, Dev Doc as changes occur
  * Assist the Devs and Tests if they need help

This week I turned in the team status report (week 7). I created a checklist of all the items that we'd like to get done for Feature Complete Release, and assigned task to the team and made sure they were on task. I worked on updating the SRS, SDS, User, and Dev docs as changes came up, but the changes were minor. I tried evaluating LabEx's application, but it turned out to have costed me more time than I have imagined. Part of the problem was that their documentation was way to vague, and I had no idea how to set up the server on my own. Although I asked for clarification and asked LabEx to improve their documentation, in the end, I could not spend any more time on it and stopped short of actually finishing the evaluations.

I also worked on part of the transaction view for the My Library page since Ken could not get it done in time, and other developers were waiting on that functionality. I (along with Ken, James, Tatsuro) demo'ed our application to the class, and I thought it went pretty smooth as there weren't much problems. I changed the UI of our applicaiton so that it matches more with the Facebook UI (based on a suggestion during the demo). I also helped test our application as our devs finish new functionality of SharingMedia.

My goals for next week are:
  * Compile team status report (week 8) for turn in
  * Do a user test with one person
  * Work on Release Canditate, with a requirements checklist
    * Assign code reviews
    * Assign user testing
  * Update SRS, SDS, User Doc, Dev Doc as changes occur
  * Assist the Devs and Tests if they need help



---


**James Parsons**

My goals from last week:
  * Complete user beta review for LabEX with John, Tatsuro, and Ken
  * Complete Transactions functionality for Friday release.
  * Keep documentation up to date as changes are made.

I accomplished all of my goals last week. I did the user beta review for labEX, setting up an Android virtual and running through their use cases. I also worked extremely hard on the Transactions functionality in our app, working over 30 hours and making small fixes all the way up until 11:59 on Friday when it was due. I was responsible for half of th Add Books use case, as well as much of the Transactions use case, and all Counteroffer and Trading implementation. When I did make any changes that affected the documentation, I made sure it was updated properly.

Goals for next week:
  * Get a friend to perform a user evaluation of our app.
  * Make sure as bugs are reported during user tests, that they are fixed in a timely manner, especially bugs concerning parts of the app I wrote.


---


**Jedidiah Jonathan**

My goals for the past week were:

  * Update the Book\_initial\_offer\_controller test
  * Test Documentation
  * Work with other testors to perform test code reviews

A major part of this week was spent in writing the book\_initial\_controller tests. These tests were working early during the week, but later the developers had to make changes (which was expected) to the test suite had to be updated to reflect the changes. I also took on the task of writing the tests for Loans\_controller, which did not seem to be too difficult as I had learnt a lot of lessons from writing tests for book\_initial\_offer\_controller and also coding/testors meeting with Greg and Tatsuro. The documentation for each of the tests were also update. I did not do any formal code review for the testors tests, but just overlooked them and we discussed a lot in our testors meeting early on in the week.

My goals for the next week are:

  * Update any failing tests in book\_initial\_offer and loans to make sure all the tests pass (or generate issues manually for tests that are not supposed to fail).
  * Update the Test documentation.
  * Code review of the developers code.



---


**Greg Brandt**


My goals from last week were to
  * Write the Exchange Books use case test
  * Write the My Library use case test
  * Finish the Transaction unit test

I completed all of my goals from last week as thoroughly as I could. There was the problem of ill-defined interfaces for a lot of modules on which both use cases depended, so the tests were an approximation of those interfaces. They all fail pretty badly as of right now, but they are more black box than glass box tests, so only a little tweaking is necessary to get them to be consistent with the new interface. Since we've just gotten through the feature complete release, the interfaces for everything will be more stable, and we'll be able to finish up our test suite.

My goals for this week are to
  * Reconcile my tests with the new interfaces
  * Expand the tests to account for more edge cases and increase coverage
  * Perform a user test
  * Perform a code review


---


**Tatsuro Oya**



My goals from last week were to
  * Write unit test for BookController
  * do Demo in class

This week, I wrote test code for BookController module. I got some issue on creating and importing multiple fixutures (dummy database for testing) into my test module. However, thanks to Greg's advice, I was able to finish up that part and finished writing test code for the bookController.php. I tried to finish user controller module but it did not work due to facebook security issue, which prevent me from testing. I also presented a part of our demo in class, which went well.


My goals for this week are to
  * Finish up all the test cases
  * Understand code throughly and finish a code review