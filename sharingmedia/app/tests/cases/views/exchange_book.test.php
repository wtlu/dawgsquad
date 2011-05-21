<?php
/**
 * File: app/tests/cases/views/exchange_book.test.php
 *
 * Tests a sample transaction between two users.
 */

class ExchangeBookTestCase extends CakeWebTestCase {

  /**
   * purpose : tests finding a book, that is in the database,
   *           selecting the book from a list of results,
   *           starting a transaction, and accepting default offer
   */
  function testAccept() {

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* all the pages we're concerned about */
    $find_page		= 'http://localhost' . $this->baseurl . 'books/find_books';
    $find_results_page	= 'http://localhost' . $this->baseurl . 'books/find_books_results';
    $transaction_page	= 'http://localhost' . $this->baseurl . 'transactions/transactions';
    $confirm_page	= 'http://localhost' . $this->baseurl . 'transactions/confirm_transaction';
    $complete_page	= 'http://localhost' . $this->baseurl . 'transactions/accept_transaction';
    
    /* go to find page */
    $this->get($find_page);

    /* find harry potter */
    $this->setFieldById('BookTitle', 'Harry Potter');
    $this->click('Continue');

    /* start transaction */
    $this->assertEqual($this->getUrl(), $find_results_page);
    $this->click('Start a Transaction');

    /* select default option */
    $this->assertEqual($this->getUrl(), $transaction_page);
    $this->click('Buy');
    $this->click('Accept');

    /* confirm */
    $this->assertEqual($this->getUrl(), $confirm_page);
    $this->click('Confirm');

    /* accepted */
    $this->assertEqual($this->getUrl(), $complete_page);

  }

  /**
   * purpose : tests finding a book that is in the database,
   *           selecting the book from a list of results,
   *           starting a transaction, countering with a different
   *           type, then redirection to my library to wait for other user
   */
  function testCounter() {

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* all the pages we're concerned about */
    $find_page		= 'http://localhost' . $this->baseurl . 'books/find_books';
    $find_results_page	= 'http://localhost' . $this->baseurl . 'books/find_books_results';
    $transaction_page	= 'http://localhost' . $this->baseurl . 'transactions/transactions';
    $counter_page       = 'http://localhost' . $this->baseurl . 'transactions/counter_transaction';
    $confirm_page	= 'http://localhost' . $this->baseurl . 'transactions/confirm_transaction';
    $my_library_page	= 'http://localhost' . $this->baseurl . 'transactions/my_transactions';
    
    /* go to find page */
    $this->get($find_page);

    /* find harry potter */
    $this->setFieldById('BookTitle', 'Harry Potter');
    $this->click('Continue');

    /* start transaction */
    $this->assertEqual($this->getUrl(), $find_results_page);
    $this->click('Start a Transaction');

    /* select counter option */
    $this->assertEqual($this->getUrl(), $transaction_page);
    $this->click('Counter Transaction');

    /* confirm */
    $this->assertEqual($this->getUrl(), $counter_page);
    $this->setFieldById('choose_loan', 'clicked');
    $this->setFieldById('TransactionLoanDuration', '12');
    $this->click('Confirm');

    /* back at my library --> transactions*/
    $this->assertEqual($this->getUrl(), $complete_page);

  }

}
?>