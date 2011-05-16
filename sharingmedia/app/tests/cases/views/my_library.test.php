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

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* all the pages we're concerned about */
    $my_books_page	= 'http://localhost' . $this->baseurl . 'book_initial_offers/my_books';
    $my_transactions_page	= 'http://localhost' . $this->baseurl . 'transactions/my_books';
    $my_loans_page	= 'http://localhost' . $this->baseurl . 'loans/my_loans';

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

    /* TODO: CHECK THE CONTENT ON MY BOOKS */

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

    /* TODO: CHECK THE CONTENT ON MY TRANSACTIONS */

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

    /* TODO: CHECK THE CONTENT ON MY LOANS */

  }

}
?>
