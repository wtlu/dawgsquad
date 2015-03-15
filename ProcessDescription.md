# Process Description #

## Tools ##

The Sharing Media project will be split into two main parts. There will be the front-end Facebook application, and a back end database to support the web application. We will be using many tools, languages and existing processes to accomplish our software development goals.

The front-end Facebook application will be coded primarily using PHP. This will allow the developers to easily create a dynamic web application. Many group members working on the front-end have experience using PHP.

The back-end database will be hosted on Amazon Web Services and created using Apache HTTP Server and MySQL. Both of these programs are free, open source, have similar tool sets, and are highly adaptable making them a perfect choice for this project.

We will use Google Code for code repository, website wiki, and bug tracking. Mercurial will be used for version control, along with the Crystal conflict detector for detecting future conflicts in our code-base.

## Group Dynamics ##

| **Wei-Ting Lu**: Project Manager, Documentation Writer |
|:-------------------------------------------------------|
| **Greg Brandt**: Integration Tester, Scripter |
| **Ken Inoue**: UI, Developer |
| **John Wang**: UI, Developer |
| **Troy Martin**: Database Administrator, Developer |
| **James Parsons**: Developer Documentation Writer |
| **Jedidiah Jonathan**: Tester, Documentation Writer |
| **Tatsuro Oya**: Tester, Diagram Maker |

Roles were based on skillsets. Wei-Ting was chosen from the beginning of project and will continue to fulfill his role. Greg Brandt has knowdlege of scripting and integration testing, and have already made many test during the dev cycle during first development of SDS, so will continue to fulfill that role. We have 4 developers to 2 testers because we wanted to get most of our functionality of the application done, and since there are 4 main parts to our application (Library, Add Books/Find Books, Transactions, Users) we thought it would be best to have 4 devs. We also felt that testing would not take as long as developing, so having 4:2 dev to tester ratio was a good mix. Other roles/tasks were done based on familiarity of said area of knowledge.

There will need to be a lot of coordination between groups to put this architecture together successfully. Wei-Ting is our project manager, and will ensure that each group is kept on track. He will also handle most of the client requests and feedback, which he can translate into action items for the group. We have set up a wiki, which is where all documents are being kept. Also, we are using Mercurial for version control. Weekly client meetings will take place on Thursdays at 7:00. Status reports will be submitted by midnight every Sunday.

## Project Schedule ##

A our project timeline can be seen in Figure 5 below:

![http://dawgsquad.googlecode.com/hg/docs/timeline/project%20timeline.png](http://dawgsquad.googlecode.com/hg/docs/timeline/project%20timeline.png)

_Figure 5: Project Schedule_

Features implemented will be tested concurrently of developement. This will make sure developers are developing to the specification. When features are complete, testing will continue after completion of functionality until the "Testing Complete" stage stated above. This is to ensure stability and functionality of our features after implementation, and fix any bugs necessary before releases.

| **Milestone** | **Date** | Wei-Ting | Greg | Ken | Jedidiah | Troy | Tatsuro | James | John |
|:--------------|:---------|:---------|:-----|:----|:---------|:-----|:--------|:------|:-----|
| Zero Feature Release | 04/29/11 |  Set up Facebook app (1 day), Developer Documentation (2 days) |  Set up splash page (1 day) |  Server Install script (2 Day) |  Developer Documentation (2 day) |  Set up Database (1 day); Write database scripts (1 day); | User Documentation (2days) |  User Documentation (2 days) | User Documentation (2 days) |
| Week Before Beta | 5/6/11 | Setup Scripts (1 day), Testing dev instructions (1 day), Update Wiki Documentats (2 day) | test scripts (2 days) |  | Testing Dev instructions (1 day); Wiki Doc Update (1 day) |  Work on user login (5 days); Layouts for website (1 days); | Read CakePHP book for testing (3 days) | Testing User instructions from LabEx (1 day), worked on user login with Troy (2 days) | Book controller (2 days); add books function (2 days) |
| Beta | 05/13/11 |  Setup scripts (1 day),  repository setup (1 day), Facebook login debug (1 day), Update Wiki Documents (4 day) | set up automation for tests on server (1 day) Add books use case test (1 day); Initial Transaction controller unit test (2 days); test documentation (1 day) |  Implement My Library (2 days) |  BookInitialOffer Controller unit test (2 days); Loans Controller unit test (1 day); Wiki Doc Update (1 day) |  Implement User controller (2 days); Continue to work on login (2 days); |  Add Books unit test(3days) User unit test, did not work (1days) Test case documentation update (1day) |  Implement BookInitialOffer (3 days), interface between AddBooks and BookInitialOffer (1 day), inc. corresponding controller and view implementations | Book controller (3 days); add books function (3 days); find books function (3 days); update SRS and User docs (1 day) |
| Feature Complete | 05/20/11 | Transactions controller (1 day), setup scripts (1 day), UI/CSS (2 days), Debug (1 day), Wiki Documentation (6 days) | Exchange book use case tests (2 days); View tests (2 day); Updated installation script (1 day) |  My Library (3 day) My Trade (2 day) |  Update Book Initial Offer (2 days); Test Documentation Updated (1 day) |  Implement Loans controller (2 days); Implemented ability to remove loans (1 day); Continue to work on login (2 days);  |  Updated Books unit test (2days) Updated fixtures (1day) Updated test documentation (1day) |  Implement Transaction: transactions main page and counteroffer functionality, including abiltiy to specify books from your library as trade options, with extensive testing and bugfixing as necessary (4 days) | Transaction controller (4 days); transaction functions (4 days); bug fixing add and find books (2 days); UI and CSS (2 days) |
| Release Candidate | 05/27/11 | Debug Login (1 day), UI/CSS (1 day), User Test (1 day), Wiki Documentation (6 days) | Update Transaction unit / use case test for new interfaces (2 day)|  transaction (1 day) | Modify some Tests (book initial offer)  to reflect Dev code (2 days); Code comments on testing (1 day); code Review (1 day) |  Bug Fixing (3 days); Implement ability to delete transactions from transactions history(1 day); Implement find books returning books only your friends have (2 days); Continue to work on login (2 days); | Updated Books unit test (1day) User Test (1day) Code review ( 1day) |  Bug Fixing, including fixes to trade books logic as well as fixing problems with display of trade options in UI of Transactions. (3 days) Performed 1 user evaluation session (1 day) | Bug fix and enhancements to transaction, add books, find books functions (3 days); user testing and feedback (1 day); general UI enhancements (3 days) |
| 1.0 Release | 06/01/11 | Wiki Documentation (3 days) | Review test suite for coverage (2 days) |  | Update Book Initial offer and Loans Controller Test code (1 day) |  Bug Fixing (1 day) | Review test case to make sure it works (1day) |  Bug Fixing, and browse functionality (2 days) |  Bug fixing in general across all modules (2 days) |



## Risk Assessment ##

The following is a list of our top 5 risks, ordered from most important to least impact.

#### Amazon Web Service (EC2) Goes Down ####

| **Likelihood of occurring** - Medium |
|:-------------------------------------|
| **Impact if it occurs** - High |
| **Evidence** - AWS EC2 went down in April 21, 2011 for several days, bringing down multiple web services such as Foursqure, Quora, Reddit, and Moby. Amazon reported that serveral accounts lost data as well. |
| **Steps to reduce likelihood** - Nothing can be done to reduce, it's on Amazon's part to make sure they don't go down. |
| **Plan for detection** - Really cannot detect other than from checking the website and reading AWS announcements. |
| **Mitigation Plan** - Ken Inoue has a backup server that will pull database data from AWS every week. Should AWS goes down, we will backup to Ken's server and bring site back up ASAP. Though this will impact performance of website if users increase as Ken's home server cannot handle large user flow. |
| **Notes** - This has changed since the original SRS and SDS because we were using Ken's server to host website, however, since then, we decided to use Amazon AWS for better uptime and bandwidth. |

#### Facebook Changes the API ####

| **Likelihood of occuring** - Medium |
|:------------------------------------|
| **Impact if it occurs** - Medium |
|**Evidence** - Last time Facebook made massive changes to their API was in April 22, 2010. It included an overhaul of their Facebook into the Graph API, which we're currently using. |
| **Steps to reduce likelihood** - Nothing can be done on our part to prevent API changes. |
|**Plan for detection** - Last time Facebook make changes to API was in their f8 conference. This year, although unannounced, is scheduled to happen in Summer 2011. We will see if they make any major changes to the API at that time. |
|**Mitigation Plan** - Since developement, we are only using the authentication and grabbing log-in info from users. If API changes does happen, hopefully our API will be backward compatiable (which it should) or give us enough warnings to make the necessary changes to our application to smoothly transition to new API code base. |

#### Application performance significantly degraded due to CakePHP framework speed/scalability issues ####

| **Likelihood of occuring** - Medium |
|:------------------------------------|
| **Impact if it occurs** - Medium |
| **Evidence** - Many posts by developers complaining about it being too slow (Google searches yield many blog posts and questions about performance issues). Although this slowdown will probably not affect our application initially, there might be scalability issues. As the number of users grow, the sluggish framework might not be able to handle the data request load by end users in an efficient way. This will make our application very unattractive to users. |
| **Reasons for still using CakePHP** - After doing a lot of research on different frameworks to use to develop our Facebook application, we found that CakePHP seemed the most straightforward, with the most documentation and examples. |
|**Steps to reduce likelihood** - Keep the operations of our application simple, and not making numerous large data requests to the back-end database. |
| **Plan for detection** - To test this, we will have to simulate numerous user inputs. These tests will allow us to get a sense of how well our application will scale, and will be especially useful after each feature is implemented. This will allow us to track the performance of our application as it grows. |
|**Mitigation Plan** - Look for ways to improve the efficiency of our application. This might include things like using a code analyzer, making sure the common cases are fast, and code refactoring to relieve bottle necks. In AWS, we can request more server power (i.e. creating more instances of our server to process more requests). |

#### Our Application is just too similar to already existing alternatives to become popular ####
| **Likelihood of occuring** - Medium |
|:------------------------------------|
| **Impact if it occurs** - Medium |
| **Evidence** -  We discovered a few, and have since discovered a few more. We spent a long time discussing how we could make our application unique , intuitive, and yet be able to complete our application by the project deadline. |
| **Steps to reduce likelihood** - Making our app with ability to barter and have transactions such as loaning, selling and trading physical media (i.e. books). Feature requests such as book suggestions and ratings are set for version 2.0. Talking with users/customers for new needs as they use our application throughout project (i.e. Team Jtacck and Punya, other students as we advertise on Facebook after Beta release for written feedback). |
| **Plan for detection** - Looking up on Google and searching for similar applications. |
| **Mitigation Plan** - Making sure we have the extra transaction functionality by version 1.0. Although there's still potential that even with our new functionality, users will not know how to use our application. Thus, after beta (and even after 1.0 release), we will ask HCDE department students (Wei-Ting have direct access to them) to use and give feedback on our interface to improve upon. We really engaged our client during the paper prototype user interaction test, and made changes based on their feedback. Having HCDE students help out (and giving us feedback on potential usability issues) we can improve our user experience. |


#### Users pursuing legal action due to lost property ####
| **Overview** - We are providing a means for students to loan their textbooks to their peers on Facebook. If a user loans their book to a friend, and the friend does not return the users property, they might seek legal action against our group since we provided the service. |
|:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Likelihood of occuring** - Low |
| **Impact if it occurs** - Medium |
| **Evidence** - It is not at all uncommon in today’s society for someone to sue some company, internet or other, for something bad happening as a result of that person using the companies product or service. |
| **Steps to reduce likelihood** - Making it clear on our website that we are not liable for any lost property. |
| **Plan for detection** - Getting emails or notices from users/lawyers. |
| **Mitigation Plan** - Include a disclaimer that basically says “use at your own risk”. Users would have to agree to this before they could use our application. Even with disclaimers, legal action happens. In the event this occurs, we would have to seek legal representation. If we made sure to be thorough in our disclaimer wordage, we will get through it just fine. |