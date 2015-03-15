# Introduction #

This is a checklist to make sure everything is done before turn-in


# Details #

Beta Release Checklist
> [ ] Opening App
> > [ ] User gets an dialog box for permissions if opening app for first time

> [ ] If user is not logged on, need to log on before seeing our main index page
> [ ] Greet User with "Hi <User Name>! Welcome to SharingMedia!"
> [ ] Description of the app
> [ ] Can click Add Books
> [ ] Can click Find Books
> [ ] Can click Library

> [ ] General Layout
> > [ ] Sidebar
> > > [ ] Has Home Sidebar
> > > [ ] Has Add Books
> > > [ ] Has Find Books
> > > [ ] Has My Library

> > [ ] Top Bar
> > > [ ] Logo
> > > [ ] Account Page
> > > > [ ] Shows "Coming Soon!"

> > > [ ] Contact Us Page
> > > > [ ] Shows "Coming Soon!"

> > > [ ] FAQ Page
> > > > [ ] Shows "Coming Soon!"

> > > [ ] Help Page
> > > > [ ] Shows "Coming Soon!"

> > > [ ] Report a Bug
> > > > [ ] Links to Google Code issues page

> [ ] Use Cases: Add Books
> > [ ] Add books main page (Enter Book Info)
> > > [ ] Can enter any info
> > > [ ] Can Click Continue

> > [ ] Confirm Book page
> > > [ ] Can see results
> > > [ ] Can select one book
> > > [ ] Can Click Back
> > > [ ] Can click Next

> > [ ] Select Offer Details
> > > [ ] Can check Loan For and enter details
> > > [ ] Can check Sell For and enter details
> > > [ ] Can check Trade For and enter details (note the UI has for lowercase, should be upper)
> > > [ ] Can see List Book Titles (What is that???)
> > > [ ] Can Click Back (to Confirm Book)

> > [ ] Confirm Selections
> > > [ ] Can see the book selected
> > > [ ] Can see the offer typed in on last setp
> > > [ ] Can click Back
> > > [ ] Can Click Finish

> > [ ] After Clicking Finish
> > > [ ] Takes you to the library page
> > > [ ] Library contains the book you just added


> [ ] Use Case: Find Books
> > [ ] Find Books main page
> > > [ ] Can enter any info
> > > [ ] Can Click Find

> > [ ] Find Books Resuls page
> > > [ ] Can see Books with details and users that owns it
> > > [ ] Click on a book will show a dialog box that says "Transactions coming soon!"


> [ ] Use Case: My Library Page
> > [ ] Has My Books Tab
> > > [ ] My Books contains all the books of the user
> > > [ ] Has button for Change offer details
> > > > [ ] When clicked, goes to "Offer Details" page (or a page that lets you change it with a confirmation page)

> > > [ ] Has Remove Button
> > > > [ ] When click remove, shows confirmation
> > > > > [ ] If user click yes, removes the book from My Library
> > > > > [ ] If user click no, goes back to My Books Page

> > [ ] Has Transactions Tab
> > > [ ] When switched to this tab, it says "Coming Soon!"

> > [ ] Has My Loans Tab
> > > [ ] When switched to this tab, it says "Coming Soon!"

> > [ ] Has Add Books Button
> > > [ ] Clicking on the button goes to the Add Books page

Tests

> [ ] Unit test for one major existing class/component in system
> > [ ] Adding Books
> > > [ ] Searching Books

> > [ ] Finding Books

> [ ] Unit Test for one part of system that's not implemented
> > [ ] Transaction Page
> > [ ] Re-editing a book offer

> [ ] System tests for the functionality represented by one use case
> > [ ] Adding Books
> > [ ] Finding Books

Version control repository

> N/A

Bug tracking System
> [ ] Greg Brandt filed a bug
> [ ] Ken Inoue filed a bug
> [ ] Jedidiah Jonathan filed a bug
> [ ] Wei-Ting Lu filed a bug
> [ ] Troy Martin filed a bug
> [ ] Tatsuro Oya filed a bug
> [ ] James Parsons filed a bug
> [ ] John Wang filed a bug

Design changes and rationale
> [ ] SRS
> > [ ] Process updated

> [ ] SDS
> > [ ] Updated descriptions
> > [ ] Class diagrams
> > [ ] Updated Team Structure

> [ ] ZFR
> > [ ] User Documentation
> > > [ ] Make sure features that are working are documented

> > [ ] Developer Documentation
> > > [ ] Use a tag for release version
> > > [ ] Don't ask the developer to edit line 290 of http.conf, patch it
> > > [ ] Run MySQL command-line tool with the DB setup in your script instead of asking developer to set permissions manually
> > > [ ] Make sure Step 2 of Joel test is followed
> > > [ ] Build and test
> > > > [ ] Cake is not in path
> > > > [ ] Automated daily build

> > > [ ] Release
> > > > [ ] hg update -r Version -0.0 doesn't work
> > > > [ ] document DB schema will never change
> > > > > [ ] Or say how developer is supposed to migrate data from old version to new one


> [ ] Updated Steps
> [ ] List two design pattern or principle discussed in class
> > [ ] MVC
> > [ ] ???