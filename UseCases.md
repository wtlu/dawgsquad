# Search / Find Books #

Finding the books that user want is one of the most important actions the user take in the software. Therefore the the use case should provide robust mechanism as well as clear definition.

| Goal | User finds the books |
|:-----|:---------------------|
| Primary Actor | User |
| Scope | Entire system |
| Level | User |
| Precondition | User logged onto the Facebook with his account |
| Success end condition | User searches the book and successfully finds the book |
| Failure end condition | User does not find the book |
| Trigger | User visits the sign in page |

Main Success Scenario
  1. User log into Facebook with his account
  1. Go to our Facebook application
  1. User fill the name of the book into the search bar
  1. User supplies information about the book into the box for further filtering
  1. System searches the book
  1. System finds the book
  1. System shows the search result

Extensions
  1. User supplies bad information about the book
    1. System warns user and lets user try again

Variations
  * None

# Share Book #

This use case is important because the value of the product is determined by how many books are shared. Therefore, the mechanism by which users share books must be robust and well defined.

| Goal | User wants to add one or more of his/her books to the collective library |
|:-----|:-------------------------------------------------------------------------|
| Primary Actor | User |
| Scope | Entire system (DB updated; new item available on front-end |
| Level | User |
| Precondition | User has a Facebook account, has installed application, and is part of one or more sharing networks |
| Success end condition | User's book recorded in database, and library displays new book as available |
| Failure end condition | User's book is not recorded in the database |
| Trigger | User uses the "share" feature on the front-end |

Main Success Scenario
  1. User opens application within Facebook
  1. System presents user with home screen
  1. User selects "share" option from home screen
  1. User enters in book information
  1. Book information is verified by system and entered into library
  1. System refreshes library on front-end, displaying User's recently added book

Extensions
  1. User enters bad book information (e.g. bad ISBN)
    1. System warns user and lets user proceed at his/her discretion

Variations
  * User selects "share" from other part of site (e.g. Facebook wall)

# Trade, Loan, or Sell Book #

The purpose of the product is to allow users to obtain books at a lower cost than what they would have otherwise paid. Therefore, the mechanism by which users exchange books must be robust and well defined.

| Goal | User opens application within Facebook |
|:-----|:---------------------------------------|
| Primary Actor | User |
| Scope | Entire system (DB updated; item no longer displayed as available on front-end |
| Level | User |
| Precondition | DB contains the book the User wants, and the book is available |
| Success end condition | User obtains book |
| Failure end condition | User does not obtain book |
| Trigger | User initiates a transaction with the owner of the book |

Main Success Scenario
  1. User opens application within Facebook
  1. System presents user with home screen
  1. User selects "trade" on available book
  1. Owner of book is notified of trade request, and enters into transaction session
  1. Through the transaction session, the owner and potential recipient agree to either: (the details of the Transaction itself appear in their Transactions tab in each of their respective Libraries)
    1. Trade book for one of recipient's books
    1. Loan the book to the recipient
    1. Sell book to the recipient
  1. User and owner agree to their choice of transaction details and confirm the transaction. Both the parties can:
    1. Exchange items via mail
    1. Meet up in person to exchange items

Extensions
  1. Book is lost in transit
> > SharingBooks is does not own any responsibility for such cases if the book is lost in transit.

# During the duration of the loan transaction, the loanee damages the book or fails the return the book in time.

> Again SharingBooks does not take an responsibility for what happens to the book during the loan duration and also for the book not being returned on-time. SharingBooks encourages its users to share books with friends they know on facebook and advises caution in interaction with friends of friends and everyone else.


Variations
  * None