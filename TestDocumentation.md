# Test Documentation #

## Intro ##

Testing is broken into four parts: unit, integration, validation, and system testing. Please obtain the repository and navigate to
```
dawgsquad/sharingmedia/app/tests/cases
```
Then the appropriate directory (e.g. controllers, views, etc.) to see the corresponding test code. The test code contains detailed comments on what actually is being tested.

## Unit Testing ##

The interesting behavior of our system is centralized in the controllers, so unit tests are developed for each controller and each of its functions. Web tests are also developed, which test the integrity of the views (i.e. all links work as expected, etc.).

## Integration Testing ##

Integration testing is performed by writing tests that emulate our primary use cases, all of which combine to use all modules in the system.

## Validation Testing ##

Validation testing is performed in the test-first method. Black-box tests were written before and during implementation, and acted as a check on developers ideas about functionality and interfaces among modules.

## System Testing ##

System testing is performed by obtaining five test users and gathering their feedback as they use the application. This feedback is used by developers to refine their design, and by testers to discover new and interesting edge cases.

## Issues ##

  * `UsersController->index()`, which adds users to the database if they're not already present, cannot be tested because it requires a Facebook session to be active. Facebook disallows sessions to be created via scripts.
  * `TransactionsController` modifies post data, which should not be the case. Once data is passed according to CakePHP conventions, the temporary code, which is marked in the test file, can be removed.