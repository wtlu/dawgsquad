<?php
/** 
 * File: app/tests/cases/views/my_library.test.php
 * 
 * Tests navigating among links on My Library page
 * and ensures that the key tables are there.
 */

class MyLibraryTestCase extends CakeWebTestCase {

  /* tests presence of layout for content */
  function testLayoutForContent() {

    /* test title */
    echo '<h2 style="color: black;">TestLayoutForContent...</h2>';

    //--------------------------------------------------
    // SETUP
    //--------------------------------------------------

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* all the pages we're concerned about */
    $my_books_page		= 'http://localhost' . $this->baseurl . 'book_initial_offers/my_books';
    $my_transactions_page	= 'http://localhost' . $this->baseurl . 'transactions/my_transactions';
    $my_loans_page		= 'http://localhost' . $this->baseurl . 'loans/my_loans';

    //--------------------------------------------------
    // MY BOOKS
    //--------------------------------------------------

    /* go to my_books page */
    $this->get($my_books_page);
    $this->assertEqual($this->getUrl(), $my_books_page);

    /* check all the tab links */
    /* on My Books... no link */
    $this->assertLink('My Transactions');
    $this->assertLink('My Loans');

    /* /\* check if there's a book pane *\/ */
    /* $this->assertPattern('/<div class="book_unit">([\s\S])*<\/div>/'); */

    /* /\* check if there's a list of books *\/ */
    /* $this->assertPattern('/<ul class="books_list">([\s\S])*<li>.*<\/li>([\s\S])*<\/ul>/'); */
    
    /* check if there's a list */
    $this->assertPattern('/<div id="list">([\s\S])*<\/div>/');

    //--------------------------------------------------
    // MY TRANSACTIONS
    //--------------------------------------------------

    /* go to the transactions page */
    $this->get($my_transactions_page);
    $this->assertEqual($this->getUrl(), $my_transactions_page);

    /* check all the tab links */
    $this->assertLink('My Books');
    /* on My Transactions... no link */
    $this->assertLink('My Loans');

    /* check if there's a list */
    $this->assertPattern('/<div id="list">([\s\S])*<\/div>/');

    //--------------------------------------------------
    // MY LOANS
    //--------------------------------------------------

    /* go to the loans page */
    $this->get($my_loans_page);
    $this->assertEqual($this->getUrl(), $my_loans_page);

    /* check all the tab links */
    $this->assertLink('My Books');
    $this->assertLink('My Transactions');

    /* FOR SOME REASON, THIS CAUSES PAGE TO PROMPT TO DOWNLOAD test.php */
    /* check if there's a list */
    /* $this->assertPattern('/<div id="list">([\s\S])*<\/div>/'); */

  }

  function testNavigation() {

    /* test title */
    echo '<h2 style="color: black;">TestNavigation...</h2>';

    //--------------------------------------------------
    // SETUP
    //--------------------------------------------------

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* all the pages we're concerned about */
    $my_books_page		= 'http://localhost' . $this->baseurl . 'book_initial_offers/my_books';
    $my_transactions_page	= 'http://localhost' . $this->baseurl . 'transactions/my_transactions';
    $my_loans_page		= 'http://localhost' . $this->baseurl . 'loans/my_loans';

    //--------------------------------------------------
    // MY BOOKS
    //--------------------------------------------------

    /* start at my books page */
    $this->get($my_books_page);
    $this->assertEqual($this->getUrl(), $my_books_page);

    /* try each link, going back each time */
    $this->click("My Transactions");
    $this->assertEqual($this->getUrl(), $my_transactions_page);
    $this->back();

    $this->click("My Loans");
    $this->assertEqual($this->getUrl(), $my_loans_page);
    $this->back();

    //--------------------------------------------------
    // MY TRANSACTIONS
    //--------------------------------------------------

    /* start at my transactions page */
    $this->get($my_transactions_page);
    $this->assertEqual($this->getUrl(), $my_transactions_page);

    /* try each link, going back each time */
    $this->click("My Books");
    $this->assertEqual($this->getUrl(), $my_books_page);
    $this->back();

    $this->click("My Loans");
    $this->assertEqual($this->getUrl(), $my_loans_page);
    $this->back();

    //--------------------------------------------------
    // MY LOANS
    //--------------------------------------------------

    /* start at my loans page */
    $this->get($my_loans_page);
    $this->assertEqual($this->getUrl(), $my_loans_page);

    /* try each link, going back each time */
    $this->click("My Books");
    $this->assertEqual($this->getUrl(), $my_books_page);
    $this->back();

    $this->click("My Transactions");
    $this->assertEqual($this->getUrl(), $my_transactions_page);
    $this->back();

  }

}
?>
