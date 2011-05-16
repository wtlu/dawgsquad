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

    /* start on my_books page */
    $this->get($my_books_page);
    $this->assertEqual($this->getUrl(), $my_books_page);

    /* check all the tab links */
    /* on My Books... no link */
    $this->assertLink('My Transactions');
    $this->assertLink('My Loans');

    /* check if there's a book pane */
    $this->assertPattern('/<div class="book_unit">([\s\S])*<\/div>/');

    /* check if there's a list of books */
    $this->assertPattern('/<ul class="books_list">([\s\S])*<li>.*<\/li>([\s\S])*<\/ul>/');
    

    //--------------------------------------------------
    // MY TRANSACTIONS
    //--------------------------------------------------

    /* go to the transactions page */
    $this->click('My Transactions');
    $this->assertEqual($this->getUrl(), $my_transactions_page);

    /* check all the tab links */
    $this->assertLink('My Books');
    /* on My Transactions... no link */
    $this->assertLink('My Loans');

    /* check if there's a transaction pane */
    $this->assertPattern('/<div class="transaction_unit">([\s\S])*<\/div>/');

    /* check if there's a list of transactions */
    $this->assertPattern('/<ul class="transactions_list">([\s\S])*<li>.*<\/li>([\s\S])*<\/ul>/');

    //--------------------------------------------------
    // MY LOANS
    //--------------------------------------------------

    /* go to the loans page */
    $this->click('My Loans');
    $this->assertEqual($this->getUrl(), $my_loans_page);

    /* check all the tab links */
    $this->assertLink('My Books');
    $this->assertLink('My Transactions');
    /* on My Loans... no link */

    /* check if there's a loan pane */
    $this->assertPattern('/<div class="loan_unit">([\s\S])*<\/div>/');

    /* check if there's a list of loans */
    $this->assertPattern('/<ul class="loans_list">([\s\S])*<li>.*<\/li>([\s\S])*<\/ul>/');

  }

}
?>
