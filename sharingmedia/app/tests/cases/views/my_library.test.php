<?php
/** 
 * File: app/tests/cases/views/my_library.test.php
 * 
 * Tests navigating among links on My Library page
 * and ensures that the key tables are there.
 */

class MyLibraryTestCase extends CakeWebTestCase {

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
    $my_books_page		= 'http://localhost' . $this->baseurl . 'book_initial_offers/my_books/';
    $my_transactions_page	= 'http://localhost' . $this->baseurl . 'transactions/my_transactions/';
    $my_loans_page		= 'http://localhost' . $this->baseurl . 'loans/my_loans/';

    //--------------------------------------------------
    // MY BOOKS
    //--------------------------------------------------

    /* start at my books page */
    $this->get($my_books_page);
    $this->assertEqual($this->getUrl(), $my_books_page);

    /* try each link, going back each time */
    $this->click("Transaction History");
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

    $this->click("Transaction History");
    $this->assertEqual($this->getUrl(), $my_transactions_page);
    $this->back();

  }

}
?>
