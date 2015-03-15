


---


# Meeting 27 - 5/4/2011 #

Time: 7:00pm - 10:00pm

Location: Odegard

Participants: Wei-Ting, Tatsuro, Greg, Troy, John, James, Ken

Updates:
  * Database Scripts ready

Activities:
  * went over assignment 6
  * decided team structure
  * set up individual local server so that we can finally start coding

Team Structure:
  * Four Developers: (Ken, John, Troy, Jedidiah)
  * Two Testers: (James, Tatsuro)
  * One Integration Tester:(Greg)
  * One Maneger: (Wei-Ting)
  * Assigned Tasks
    * User module: Developer(Troy), Tester(Tatsuro)
    * Library module: Developer(Ken), Tester(Tatsuro)
    * Book module: Developer(John), Tester(James)
    * BookInitialOffer module: Developer(Jedidiah), Tester(James)
    * Transaction module: (do this later)

To set-up local coding environment:

  1. hg pull, hg merge, hg update, run apache, and run mysql
  1. Open xampp\apache\conf\httpd.conf
    * Change DocumentRoot "C:/xampp/htdocs" To DocumentRoot "C :/<yourpath to dropbox>/Dropbox/D.A.W.G. 	Squad/codeRepo/yourname/dawgsquad"
    * Change <Directory "C:/xampp/htdocs"> To <Directory "C:/<yourpath to dropbox> /Dropbox/D.A.W.G. 	Squad/codeRepo/yourname/dawgsquad">
  1. Add the following Path to envirinmental var's path : C:/xamp/mysql.bin
  1. Go to <your repo>/tools (this is where .sql which need to be run exist)
  1. Run command prompt from there
  1. Log into my sql by this command: mysql – u root
  1. See the database by this command: show databases; (nothing yet)
  1. Run sql by this command:
    * source media\_db\_setup.sql
    * source dummy\_values.sql
    * sourse user\_setup.sql
  1. Choose database to media\_db by this command: use media\_db
  1. create persistence folder at \xampp\htdocs\cake\app\tmp\cache
  1. go to front page http://localhost/sharingmedia/index.php/pages/index
  1. done!


Notes:
  * let's add more contents for individual update
  * about SDS/SRS update: Be more specific. E.g. why you choose that and so on
  * Now that we set up an environment, start coding individually and see how it works
    * We will see how our team structure works and make a final decision on Monday




---


# Meeting 26 - 5/3/2011 #

Time: 9:30am - 10:20am

Location: EEB 037

Participants: Wei-Ting, Tatsuro, Greg, Troy, Jedidiah, John, James, Ken, Punya

Updates:
  * AWS is set up; we have the AWS code from Punya

Notes:
  * Go over SDS with Punya
  * Gave feedback to Punya regarding the class
  * Discuss new UML class diagram
    * Received some feedback from Punya
      * Describe Transactions; already modeled in Database Model
      * Need to mention that Model fields can be null
      * Describe the purpose of BookInitialoffer
  * Discuss setting up Cake on AWS

Customer Discussion:
  * How do we handle users' transactions if only one is logged in?
    * It's not synchronous...
    * ... but that's what the sequence diagram says
  * Want to see some representation of the array of books for a trade in class diagram
  * Need to explain mutual exclusivity for type of exchange (trade, sell, loan)
    * This is an appropriate thing to go in the explanation of the diagram

Action Items:
  * Add Books
  * Find Books
  * My Library
  * Describe tranaction process in SDS
  * Finish updating SRS


---


# Meeting 25 - 5/1/2011 #

Time: 2:00pm - 6:00 pm

Location: Denny  Hall

Participants: Wei-Ting, Troy, James, John, Jedidiah ,Tatsuro

Updates:

Agenda:
  * Class Diagrams
  * MVC
  * Team Structure
  * Beta Releae

Action:
  * Troy set up EC2 (amazon web server) and installed Apache
  * Updated UML class diagram based on MVC
    * MVC concept: Each model has corresponding controller and controller handles several views.
    * Started with thinking about views -> then shifted to controller and finally Model
  * Finished UML calss diagram

Note:
  * James and Jedi works on updating SRS
  * John, Wei-Ting, Tatsuro works on updating SDS
  * Team structure and Beta release are not finished yet