# Individual Updates #
# Week of 5/22/2011 - 5/28/2011 #


---


**John Wang**

My goals from last week were:
  * Touch up and add more comments my code.
  * Recruit a user to do user testing.
  * Participate in code reviews; review a tester's code

This week, I helped fix bugs in some of the controllers, and also added a few enhancements to our product. These include the ability to cancel ongoing transactions and color coding of transactions and loans in my library. I used one of my roommates for the user test. My roommate has very little computing background, and provided very good feedback about our product, which we took into account when doing bug fixes and adding more enhancements.

My goals for next week are:
  * Help fix rest of bugs particularly high priority or critical ones. Mark rest as will not fix.
  * Make sure application is ready for 1.0 release.


---

**Ken Inoue**
Last weeks goals:
  * Help Find testers
  * Comment my code more clearly and clean it up.
  * help with the code reviews

I helped fixed a number of bugs and reworking the layout of the app this week. I also read the feedback we received from users and used that to update the apps functionality. I also took time to re-factor the code so that User ID were passed by parameters instead of being read in the controller from the session. This is more consistent with MCV.

My goal for this week:
  * get the product ready for final release


---


**Troy Martin**

My goals from last week:

  * Make changes to our application based on usability testing feedback.
  * Continue to correct bugs for our release candidate due Friday.

This week I performed a usability test and got a lot of feedback from my test subject. I used this feedback to make changes to our application. These changes were primarily related to basic layout, appearance, and descriptions to increase usability. I also implemented the find books results only showing you your friends books.

Other than that I tried to fix bugs as they came up. Most of these bugs were minor visual, placement, or wording corrections.

My goals for next week:

  * Ensure our application is ready for release
  * Fix bugs so their status is either complete or won't fix.


---


**Wei-Ting Lu**
My goals from last week were:
  * Compile team status report (week 8) for turn in
  * Do a user test with one person
  * Work on Release Canditate, with a requirements checklist
    * Assign code reviews
    * Assign user testing
  * Update SRS, SDS, User Doc, Dev Doc as changes occur
  * Assist the Devs and Tests if they need help

This week I turned in the team status report (week 8). I assigned user test to 5 team members (Greg, James, John, Tatsuro, Troy). I orginally was going to do a user test on my own, but due to time restraint I ended up doing one together with Troy. Through these user testing we've saw how there has been some consistent issues that our users faced when using our application. Since then we fixed some of those problems. I also assigned code reviews to the testers to review the dev's code (in Books, BookInitialOffers, and Transactions). I also updated the SDS, User Doc, and Dev Docs as changes occured in the release candidate (mostly just pictures of UI, which changed because of user testing).

My goals for next week are:
  * Compile team status report (week 9) for turn in
  * Update SRS, SDS, User Doc, Dev Doc as changes occur
  * Work on Postmortem Document
  * Work on Demo Powerpoint
  * Assist the Devs and Tests if they need help
  * Release 1.0



---


**James Parsons**

Goals from last week:
  * Get a friend to perform a user evaluation of our app.
  * Make sure as bugs are reported during user tests, that they are fixed in a timely manner, especially bugs concerning parts of the app I wrote.

I did have a friend do a user test of our app. Andrew Poleon gave some good feedback on our app, including a great way to improve the way books that are proposed as trades are displayed in the myTransactions tab, as well as some style issues throughout that made navigation confusing. Please see the full user testing doc for details. I also spent time stamping out bugs, the most signifcant was as follows: the user proposes a counteroffer with book1 as a trade option in order to obtain book2. Subsequently, book1 is bought or traded for, and the user does not have book1 any more. Then the other user accepts book1 in trade for book2. I added some safeguards to the transactions code in order check for and prevent these types of situations. Other bugs that I fixed can be viewed in the issue tracking on our google code site.

Goals for next week:
  * Implement the browse feature, to allow a user to see all the books their friends have added. This was requested by several user reviewers.
  * Work to make sure all bugs are fixed for 1.0 release.


---


**Jedidiah Jonathan**

My goals for the past week were:
  * Update any failing tests in book\_initial\_offer and loans to make sure all the tests pass (or generate issues manually for tests that are not supposed to fail).
  * Update the Test documentation.
  * Code review of the developers code.

This week was spent in fine tuning the tests (Book initial Offer and Loans Controller). The Dev's made some changes to the function signatures so a lot of tests were failing early in the week which were fixed before the due date. Some functions still need refactor, so corresponding tests have been disabled and been properly documented in code comments for any further review. Test documentation was updated to for the tests. I even ran a code review for the Book Initial offer controller which has been documented and included in our project wiki.

The goals for next week:
  * Final tune up for the tests, to make sure all pass for the 1.0 release
  * Take on any new tasks that the team wants to get done to stay on schedule for the 1.0 release.


---


**Greg Brandt**

My goals from last week were to
  * Reconcile my tests with new interfaces
  * Expand tests to account for more edge cases and increase coverage
  * Perform a user test
  * Perform a code review

I reconciled the tests as best as I could within the scope of the testing framework. However, due to the reliance of the Transaction controller on session information, it is unlikely that all tests will be pass by release. It would be a mistake to manipulate the tests to pass by relying on implementation details; this defeats the purpose of black box testing. I wrote tests for the Exchange books use cases using the Transactions controller, though, assuming a few possible interfaces for the relevant methods.

I performed a user test with my friend who is in the business school. He had a hard time understanding the details of the transaction use case. I also performed a code review on the Transaction model, controller, and views. The main problem that I saw was lack of adherence to CakePHP and through that, the MVC design pattern.

My goals for next week are to
  * Ensure that tests cover our use cases as thoroughly as possible
  * Justify in documentation any reasons that tests fail and under which conditions they'll pass



---


**Tatsuro Oya**

My goals from last week were:
  * Finish up all the test cases
  * Understand code throughly and finish a code review

This week I finished up the test case and finished code review, I was in charge of writing the code review for book controller and views that are associated with it. Since I have been working as a tester, it was great exparience to deeply look through the code to find the place to be improved. I also asked my brother to do user test and he gave us great feedback about our user documentation.

My goals for next week are:
  * Make all test cases work
  * Finish Final Release
  * study for final exam