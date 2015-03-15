


---

# Meeting 16 - 4/22/2011 #
Time: 4:00pm - 7:00pm

Location: Odegaard Study Room

Participants: Wei-Ting, Tatsuro, Greg, Troy, Ken, Jedidiah, John

## Updates to Product ##
  * Move recommendations and favorites to v2.0
  * Get rid of protected profile notion in our product
    * Already covered by Facebook profile

## Zero Feature Action Items ##

| Greg | Make splash page |
|:-----|:-----------------|
| Ken | Set up server |
| Wei-Ting | Register Facebook application |
| John, Troy, Tatsuro | Learn CakePHP and start setting up classes |
| Jedidiah, James | Set up database and generate test data |

LAMP installation instructions
  * http://www.howtoforge.com/ubuntu_debian_lamp_server
  * This uses Ubuntu's package manager, but we can change it for whatever package manager the CSE VM uses

## Presentation ##
  * Greg - slides 2,3
  * John - slides 4,5
  * Troy - slides 6,7,8
  * Jedidiah - slides 9,10,11

**Conference call Sunday @ 5pm**


---

# Meeting 15 - 4/21/2011 #

Time: 5:00pm - 6:00pm

Location: CSE021

Participants: Wei-Ting, Tatsuro, Greg, Troy, Ken, Jedidiah

## Agenda ##
  * Create UML User Interface Class

## Updates ##
  * Thanks to T.A.’s advice, we decided to add User Interface class to our UML class diagram.
  * Worked on and added new features to our UML class diagram.
    * What we have done for our class diagram only contains controller part. So we discussed how we can add User Interface part into our use case diagram.
    * To do this, we first organized high level view of our entire architecture and came up with the idea of what we need for our UI view. ![http://dawgsquad.googlecode.com/hg/docs/UML/highLevelView.png](http://dawgsquad.googlecode.com/hg/docs/UML/highLevelView.png)
    * Then we created the prototype diagram of User Interface view. ![http://dawgsquad.googlecode.com/hg/docs/UML/protoUI.png](http://dawgsquad.googlecode.com/hg/docs/UML/protoUI.png)
    * Based on this, we created and add class diagram for User Interface.
  * We also talked about the other staffs which are listed in the following section.

## Notes ##
  * For now we have decided to use CakePHP for our web frame work
  * Definition of front end and back end changed: controller is now part of back-end.
  * We will have some people move to back end because business class is part of the back-end class



---


# Meeting 14 - 4/21/2011 #

Time: 4:30pm - 5:00pm

Location: CSE002

Participants: Wei-Ting, Tatsuro, Greg, Troy, Ken, Jedidiah, Punya(Customer)

## Agenda ##
  * Feedback on the UML class Diagram from Punya.
  * Team asks Punya any other questions on their mind. Create UML User Interface Class


## Notes ##
  * Coding Standards:
Punya suggests that we could use an already existing PHP framework for the UI. For example: use already existing Plug-ins for using textsearches instead of spending time writing all that code.

  * UML Class Diagram
Team out of sync with how the class diagram talks to the UI. Team begins to talk about modifying the Class Diagram.

## Action Items ##
  * Iterate over the SDS doc that is due on Friday night. Each member has to complete tasks assigned.
  * Team will meet at 5:00pm to talk about Modules in the UML Class diagram that should be there.

---


# Meeting 13 - 4/20/2011 #

Time: 6:00pm-7:00pm

Location: Odegaard

Participants: Wei-Ting, John, Tatsuro, Greg, Troy, James

## Agenda ##

  * Determine status of Assignment 4, divide up remaining work.

## Updates ##

## Notes ##

  * Meeting with Punya 4:30 CSE002 (Thursday 4/21/2011)
  * Team Meeting immediatly afterwards
    * Meet in Odegaard
    * Look over everything, work if necessary, finalize
    * Afterwards, presentation can be created
  * Turn-In by Friday Evening (Exact deadline 11:30pm)

## Action Items ##

  * View of architecture from Customer View - Greg
    * Really high level view
  * Draw up E/R diagram - James P
  * Summary of System Architecture / Each Diagram
    * Customer View Desc. - Greg
    * Database Summary - James P
    * UML Class diagram Desc. - John
    * Sequence Diagram Psuedocode Comments - Greg
    * Sequence Diagram Summary - Tatsuro
  * Risk Assessment - Troy
  * Team Structure - Troy
  * Schedule - Wei-Ting
  * Documentation Plan - Wei-Ting
  * Coding Guidelines - Wei-Ting
  * Test Plan
    * Unit Testing System - Jedidiah
    * System Test Strategy - Jedidiah
    * Usability Test Strategy - Ken
    * Adequacy of Test Strat - Ken
    * Bug Tracking Mechanism - Ken
  * Creating the Presentation - Ken and Jedidiah
    * Should be straightforward, pull existing diagrams from our wiki on Thursday night
  * Presenting the Presentation - Ken, Jedidiah, James, Troy

## Go Dawgs ##


---


# Meeting 12 - 4/19/2011 #

Time: 9:30-10:30

Location: EEB037

Participants: Wei-Ting (Skype), John, Tatsuro, Greg, Troy, James, Ken, Jedidiah

## Agenda ##

  * Go over UML Class diagrams and Database schemas.
  * Start on Sequence Diagrams.

## Updates ##


## Notes ##

  * Went over UML Class diagrams and Database schemas.
    * Made a few changes to UML Class diagram.
  * Fleshed out Sequence diagram.
    * Tatsuro drew it on Visio.


## Action Items ##

  * Finish up Sequence diagrams, divvy up work for process documents


---


# Meeting 11 - 4/18/2011 #

## Agenda ##
  * Flesh out UML class diagrams
## Updates ##
  * John and Ken updated UI
  * Ken has preliminary logo (please edit / critique)
## UML Class Diagram Summary ##
### User ###
  * Fields
    * facebookID : int
    * firstName : String
    * lastName : String
    * myLibrary : Library
  * Methods
    * startTransaction()
    * endTransaction()
    * addToMyLibrary()
    * removeFromMyLibrary()
    * acceptOffer()
    * declineOffer()
### Library ###
  * Fields
    * myBooks : Array of Books
    * myLoans : Array of Books
    * myTrades : Array of Trades
  * Methods
    * addBook()
    * addTrade()
    * addLoan()
    * remove for all of the above
### Trade ###
  * Fields
    * owner : User
    * client : User
    * book : Book
    * ownerOffer : Offer
    * clientOffer : Offer
    * finished : boolean
### Book ###
  * Fields
    * picture : String (URL)
    * ISBN : int
    * title : String
    * author : String
    * offer : Offer
    * summary : String
### Offer ###
  * Fields
    * willTradeFor : Array of Books
    * willSellFor : double
    * willLoanFor : int

### Facebook API ###
  * Methods
    * FB.getLoginStatus (JavaScript)
      * validates session, and gets Facebook uid, etc.
      * can use http://graph.facebook.com/uid to retrieve JSON object containing info about Facebook user

### Google Book API ###
  * Methods
    * google.search.bookSearch() (PHP)
      * creates instance of a book search
    * bookSearch.execute("bookName")
      * searches google for particular book and returns info on that book


---


# Meeting 10 - 4/17/2011 #

Time: 2:00pm - 4:30pm

Location: Paccar

Participants: Wei-Ting, John, Tatsuro, Greg, Troy, James, Ken, Jedidiah

## Agenda ##

  * Go over feedback on paper prototype
  * Finish up assignment 3 writeups
  * Modularize work for assignment 4

## Updates ##

  * Worked over product description

## Notes ##

  * Assignment 3 - Update prototype (see action items)
  * Bonus - price suggestions
  * Bonus - helping the seller
    * Wish lists and search for wanted
  * Assignment 4
    * Individually read over assignment 4 writeup
    * System architecture
      * 2 views:
        * Customer view - high level, what user sees, nothing from back end
        * Developer view - includes everything, interface from front end to back end
      * Class diagrams
        * Diagrams of all major classes and address aspects of our design
      * 2 use cases:
        * Need 2 UML sequences
    * Process
      * 
    * Presentation
      * 

## Action Items ##

  * Update prototypes
    * Add product description and some "quick help" to homepage
    * Make changes to the add book use case
      * Step 1: Fill out intial add book form
      * Step 2: Confirm book selection
      * Step 3: Fill out offer details
      * Step 4: Final confirmation
    * Make changes to bargaining use case
      * Modify option buttons and descriptions
    * Modify My Library page
      * "transactions" tab
      * "my loans" tab - separate loaned and owned books
      * "my library" tab
    * Add an FAQ page
  * Finish individual and team status updates
  * Do assignment 3 reflections
  * Each group does their share of assignment 4
    * Front end - Class UML diagrams
    * Back end - Database schema
  * Do your readings!

## Schedule ##
  * Monday night meetings
  * Meet on Tuesday 9:30am to discuss progress on architecture documentation
  * Wednesday night
  * Thursday night