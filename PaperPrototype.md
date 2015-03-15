# Paper Prototype Exercise -- 4/15 #

We met with Team Jtacck to test our paper prototype. Kevin Anderson (right?) was the user, Wei-Ting was the facilitator, John was the "computer", and James, Greg, and Jedidiah were observers.

## Finding a Book ##

  * User went to FAQ / Help first because he didn't know what to do
  * User clicked on find book, entered in author / title, then clicked submit
  * User selected a book in the "Available" results page

## Trading Books ##

  * When displayed the bargain page, User was confused about the price the owner was willing to sell the book for
  * Was not immediately apparent to the user that prices, etc. were negotiable
  * User was redirected to "My Library" after successfully making an offer
  * User had to make sure with us tht if he bought a book, it wouldn't show up in "Checked Out" tab in "My Library"
  * If user was willing to sell a book, he would...
    * Search for that book and determine what others are selling the book for
      * This requires going to the bargain page each time
    * Come back to the fields page and add it again
      * This requires searching for the book each time, then deciding whether to add to "My Library" or "Wishlist"
  * User's assumption of "Wanted" was correct
  * User was confused whether bargaining options were radio buttons vs. checkboxes
  * User asked whether system tells user how to meet the client...
    * Currently, no
    * We send a message, seller gets the message, then it's out of our hands
  * Maybe we need to write "If none of these options are to your liking, request counter offer..." on bargaining page
  * Should have an auto populate feature in the Trade box in the counter offer page
    * Linked to a user's available books
  * If a user wants to sell a book, he would...
    * Go to Wanted to see if anyone is offering an acceptable price
    * If so, offer it to that user
    * Else, look at Available to see other prices on the market, then "Add Book"

## Adding a Book ##

  * User clicked "Add Book", was presented with search interface
  * User didn't know how to find ISBN, thought that should be in FAQ
  * User was confused when presented with book results... not sure what to do
    * Asked if there were details that should have been there, that we omitted
    * If the book he wanted didn't show up, he wouldn't know what to do
  * What would happen if the book wasn't in the search results?
    * User would try to search again, enter more information
    * If the book still isn't there, the user would have no idea what to do
  * User expected an Add Book page with fields for various information about the book from the beginning
    * The search idea wasn't intuitive when adding books
  * User thought that the two pop-ups for adding should some how be combined into one page, and remove the search function altogether
  * User understood the exclamation mark in "Wishlist" tab in "My Library"
    * (If a book he wanted were added, he'd get a notification here)

## General Notes ##

  * User didn't notice a difference between finding a book and bargaining as use cases
    * Bargaining is dependent on finding books
  * User finds it inconvenient that he has to go through entire find books process in order to get to the bargaining screen
    * He didn't actually hit an offer button, but was still interested in the book
    * Fix with recently viewed page in "My Library"?
  * Should we put past transactions in "My Library"?
  * What happens if the book the user wants is not in the system at all (i.e. Google Books)?
  * User doesn't know exactly what Search box is for...
    * Could be network or Google Books
  * If user didn't really know much information about a book, he might go to "Find Books" first...
    * But this goes to the local database, not the Google database
    * Our "Find Books" function would have to search both databases to provide that functionality
  * User doesn't know why "Wish List" button is in "Add Books" section
    * Was expecting something more than just taking him to my library to "Wish List" page
    * Expecting if someone was already offering a book he added to his "Wish List", system would take him to that book's result page
    * User would rather skip going to my library and go to a page with all the books being offered that match with the one that he just added to "Wish List"

## Summary ##

  * "Add Books" and "Find Books" are confusing because you have to search to add
  * User thinks program allows people to get rid of old books they don't want and potentially find books for cheaper than at the bookstore, etc.
  * Loaning didn't stand out as much as sell or trade to user...
  * User didn't notice any intergration with Facebook interface (even after being told that it was a Facebook application)
  * Advanatge of product: larger network to do things like loaning, but there aren't  any features that make loaning easy...
  * User would use this service if none of friends have book, or no one he knows would have book