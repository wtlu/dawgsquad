


---


# Meeting 8 - 4/12/2011 - UI Review #

## Agenda ##

  * Review UI
  * Divide work for Paper Prototype

## Updates ##

  * Wei-Ting
    * Updated wiki (navigation, team info, etc..)
    * Compiled and turned in SRS (Assn. 2)

## UI Review ##

General
  * Product Page as homepage is ambiguous
    * Change to description of application itself?
    * Change homepage to Personal Profile page?
  * Put Account, Faq, Help, etc.. at top of every page
  * Put about, copyright, contact.. at bottom of every page

Home Page
  * Application profile link, Search, Help, FAQ @ top
  * Big area with three buttons (simplifies first impression)...
    * My Library
    * Find Books
    * Add Books

My Library
  * I own
  * I want
  * Add books
  * Acct. settings

Offer Page
  * Pop-up when user makes a transaction

## Paper Prototype Discussion (Assn. 3) ##

Notes
  * "Balsamic" for wireframes?

Dividing work
  1. Refine UI (using whiteboard)
  1. Assign each page to one or two people in group



---


# Meeting 7 - 4/10/2011 - Set up VC, Set up Wiki, Wrapping up SRS #

Time: 12:00-3:30

Location: Paccar

Participants: Wei-Ting, John, Tatsuro, Greg, Troy, James, Ken

## Agenda ##

  * Updates
  * Idea for new SharingBooks
  * Work

## Updates ##

  * Wei-Ting
    * Use DropBox for preemptive conflict resolution
    * Read directions on how to use crystal.jar
  * Ken
    * Set up Google code site
  * Tastsuro / John
    * "College Swap" is a Facebook app that does pretty much everything that we wanted our product to do (as of last meeting)

## New Ideas ##

  * Coordinate schedules
  * Barter
  * Location data
  * Library checkout system
  * Trade loan sell

## Notes ##

  * Wei-Ting
    * Added link to our wiki on CSE wiki
    * Added course staff to our mailing list, but they can't receive mail (post only)

## Refined Requirements ##

**Idea: Book (only) sharing application with bartering options: share, trade, loan, sell**

## Action Items ##

  * Everyone: Individual status updates by 12:00 am (tonight)
  * Everyone: SRS documents on Wiki by 6:00 pm 4/11
  * Wei-Ting: Print PDFs of SRS documents for turn-in


---


# Meeting 6 - 4/8/2011 - Lab Med. 2 Mtg. #

Time: 3:30-4:00

Participants: Wei-Ting, John, Tatsuro, Greg, Troy, James, Ken

Customers: Jesse, Andrew, Rest of Lab Medicine 2

## Agenda ##

  * Meet with Lab Medicine 2
  * Discuss alternatives to our project

## Lab Medicine 2 Notes ##

  * Will be an Android application and web interface
  * Interface was introduced to our team

## Lab Medicine 2 Questions / Answers ##

  * How does your tracking system work?
    * Lab samples are driven around by the trucks and are scanned in at each destination
    * Problem: Truckload of package do you just scan all of them?
      * Maybe just one barcode that contains all items in them
    * What if the driver doesn't scan it? Not a clear solution; have to trust.
    * Not HPAA Compliant. Doesn't need to be
  * Generate barcode on the fly or have barcode sticker (pre-generated)?
    * Generate barcode on the fly might be better
    * Hardware barcode generator like UPS guys

## Our Meeting Notes ##

  * University based application
  * Textbooks, linking to classes
  * Web crawl for all courses offered during the current quarter at the UW, and their required textbooks?
  * Students upload the media that they own to their online inventory
  * Our application can keep track of these media and their statuses, students can then borrow, rent, sell these media
    * Could involve a **bartering system**
  * Benefit: the university does not yet have a centralized database of textbooks

## Our Questions / Answers ##

  * Are there legal / tax issues?
    * No

## Action Items ##

  * Look up alternatives to this bartering application
  * Rework all of our documents
  * Start using Google Code wiki for our docs

## Next Meeting ##

  * Sunday 4/10 12:00 pm in Paccar


---


# Meeting 5 - 4/8/2011 - Customer Mtg. (group) #

Time: 11:30-12:20

Location: Odegaard

Participants: Troy, John, Jedidiah, Ken

Customers: Jesse, Andrew

## Agenda ##

  * Present functionality / requirements
  * Present features
  * Present UI
  * Risks
  * Use Cases

## Questions / Answers ##

  * Doesn't something like this already exist on Facebook?
  * What features are you delivering?
    * Filters
    * Search friends
    * Review members / items
    * Tags
    * Interest groups
  * Have you thought about localized search?
    * Yes, we're implementing the ability to search people in your local networks (based on geographical localtion)
  * How will people get books?
    * Meeting
    * Shipping
  * What does your UI look like?
    * Discussed the app
  * Are you implementing the ability to buy books?
    * Not the focus
    * Will be added as a bonus
  * What are your major failure cases?
    * Facebook changes the API
    * How do we enter books into app?
    * Similar app already exists

## Comments ##

  * Found Facebook app called "Book Sharing" that is almost identical to what we want to implement
    * Turns out not to do a lot of things we were planning on implementing
      * Doesn't keep track of who you lent the books too
      * Doesn't facilitate the exchange of books
  * Should add feature to check the public library to find books that none of your friends have

## Action Items ##

  * Everybody: Investigate "Book Sharing" app and "Swap A DVD" app
  * Everybody: Start thinking about paper prototype


---


# Meeting 4 - 4/7/2011 - Customer Mtg. (Punya) #

Time: 7:00-10:20

Location: Odegaard

Participants: Wei-Ting, Troy, James, John, Greg, Jedidiah, Tatsuro, Ken, Punya

## Agenda ##

  1. Meet with our customer Punya to discuss our project
  1. Discuss more about our project

## Notes from Punya ##

  * Facebook application or LAMP based web app
    * Pro Facebook / Con LAMP
      * Networking and social resources already available
      * Facebook API already available, don't need to implement much of our own
      * Simplify project
    * Con Facebook / Pro LAMP
      * Part of Facebook app needs to be run on our server (DB)
      * Facebook could change API (in the middle of our dev. cycle?)
      * With LAMP, we could be more independent
      * If we do LAMP, might be a more complete software development experience

**Decision is to go with Facebook application**

  * Delicious library, how does our application compare
  * How do we input ISBNs?
    * Barcode scanning?
  * Use bare CS VM, attu, or some other system?
  * Scope of our application...
    * How many members, friends in each person's network?

## Advice from Punya ##

  * Check what applications already exist
    * If similar apps exist, we're still okay as long as "it's not on the first page of a Google search"
  * Turn our Google Docs into live documents
  * Include technical risks, business risks are okay
  * Make a decision, pick a technology stack, start on it and stick to it

## Other Notes ##

  * Decided on Mercurial
  * Need to set up development web page
  * Everyone should write a few sentences about what they planned to do and what they have done, and place this on the repository

## Next Meeting ##

  * Meeting with other groups
    * Our customers will also provide us advice, and can look over our app as we progress and see how they like it
  * Friday after class w/ Lab specimen 2 - John, Ken, Jedidiah
  * Friday 3:30 pm w/ Lab specimen 1 - James, Troy, Tatsuro, John, Greg


---


# Meeting 3 - 4/6/2011 - Preliminaries #

Time: 7:00-10:20

Location: Odegaard

Participants: Wei-Ting, Troy, James, John, Greg, Jedidiah, Tatsuro, Ken

## Agenda ##

  1. Contact info
  1. Review of last meeting
  1. Feature and UI Discussion
  1. Use Case Discussion

## Contact Information ##

| **Name** | **Phone** | **Skype** |
|:---------|:----------|:----------|
| Wei-Ting Lu | (206) 965-0988  -- text: (206) 395-9858 | wtlu89 |
| John Wang | (425) 802-6624 | john.y.wang81290 |
| Jedidiah Jonathan | (253) 334-6794 | jedidiahjonathan |
| James Parsons | (425) 308-9066 | parsonsx@gmail.com |
| Greg Brandt | (206) 697-6031 | brandt.greg |
| Tatsuro Oya | (206) 931-8880 | challenger-0123 |
| Troy Martin | (425) 691-1649 | tmartin.seattle |
| Ken Inoue | (206) 947-7873 | ktinoue |

## Notes ##

  1. Possible expansion of product description to other media
  1. Feature discussion
    1. Implement "favorite" or "preferred" members, so when you search for items, your favorite member will appear higher in the results if they own the item you're looking for
  1. Tools Discussion
    1. Mercurial - Version Control
    1. Google Code - Bug Tracking
    1. LAMP - Web technology
  1. Assignment of Roles
    1. Designers vs. Test
      1. Everyone develops first
      1. Test team forms as code base grows
  1. Names
    1. Team Name: D.A.W.G. Squad
    1. Product Name: SharingBooks

## Action Items ##

  1. Fill out in more detail the features listed in the design spec - James
  1. Contact Lab Medicine 2 (our customer) and setup a meeting - Wei-Ting
  1. Contact TAs (Miles?) to setup a meeting time (customer) - Jedidiah
  1. Meeting **Friday 3:30** @CSE Building with Lab 1 (we are customer)
  1. Meeting **Thursday 6:00** @Odegaard with Punya (he is customer)

## Next Meeting ##

  1. Meeting with Lab 2 (our customer) pending response to Wei-Ting


---


# Meeting 2 - 4/5/2011 - Initial UI Design #

Time: 10:30-11:20

Location: Undergrad lab

Participants: John, Jedidiah, Ken

## Agenda ##

  1. Brainstorm the product description
  1. Brainstorm the UI diagrams

## Notes ##

All participants actively collaborated with ideas to come up with a rough sketch of the product description.

## Action Items ##

  1. Jedidiah begin working on Product Description. Deliverable by midnight of 4/5.
  1. Ken and James to start the formal documentation of the UI diagrams
  1. Talk to team about idea that we might want to consider sharing other types of media (CD's, DVD's...)

## Next Meeting ##

  * Waiting for Doodle poll results


---


# Meeting 1 - 4/5/2011 - Initial product discussion #

Time: 9:30-10:20

Location: EEB 037

Participants: Wei-Ting, Troy, James, John, Greg, Jedidiah, Tatsuro, Ken

## Agenda ##
  1. Introduce the project idea to each group member
  1. Look at Assignment #2 and make plans to meet the deadline

## Notes ##
  1. A few members were concerned to figure out the "external factors" why our top 2 projects were turned down. Resolved by them talking directly to the Class Instructor. Team agreed to focus on the assigned project and work together to make the project successful.

  1. Books could include Media as CD's, DVD's, and VHS tapes.

  1. Version control ideas: svn, git, etc... talk about this later

  1. Assignment 2 delegation:
    1. Product description: Jedidiah and James
    1. UI Diagrams: Ken and John
    1. Use Cases: Greg and Tatsuro
    1. Process Description: Wei-Ting and Troy

  1. Team roles:
    1. PM: Wei-Ting
    1. Front-end: Ken, John, Greg, Tatsuro, Wei-Ting
    1. Integration: Not decided yet
    1. Back-end: James, Jedidiah, Troy

## Action Items ##

  1. Jedidiah, John, and Ken work on Product Description, later from 10:30-11:30 same day
  1. Wei-Ting set up doodle to have a next meeting

## Next Meeting ##

  1. Jedidiah, John, and Ken on Product Description and UI from 10:30-11:30 on 4/5 in the Undergrad Project Lab
  1. All members meet after the Doodle poll results are collaborated