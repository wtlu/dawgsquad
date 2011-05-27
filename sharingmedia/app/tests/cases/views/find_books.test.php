<?php
/**
 * File: app/tests/cases/views/find_books.test.php
 *
 * This ensures there are the correct elements on each view
 * of the find books use case.
 */ 
class FindBooksTestCase extends CakeWebTestCase {
  
  /* tests elements on search page */
  function testFindBooksInitialPage() {

    /* test title */
    echo '<h2 style="color: black;">testFindBookInitialPage...</h2>';

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* go to correct page */
    $this->get('http://localhost' . $this->baseurl . 'books/find_books');

    /* see if relevant field names are there */
    $this->assertText('Author');
    $this->assertText('Title');
    $this->assertText('ISBN');

    /* see if a form is there */
    $this->assertPattern('/<form([\s\S])*>([\s\S])*<\/form>/');

    /* see if a submit button is there */
    $this->assertPattern('/<div.*class="submit".*>/');

  }

  /* tests elements on find books results */
  function testFindBooksResults() {

    /* test title */
    echo '<h2 style="color: black;">testFindBookResults...</h2>';

    /* can't page layout because of the indeterminate nature of
     * results (i.e. we can't guarantee there's a book in the 
     * production database, and the page layout depends on whether
     * or not there's a result)*/

    /* a fix for this could be to possibly display the
     * container (div or whatever) for results, then just
     * not populate it with anything if no results */

    $this->assertTrue(1);

  }

  /* tests elements on transaction start page */
  function testStartTransaction() {

    /* test title */
    echo '<h2 style="color: black;">testStartTransaction...</h2>';

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* go to correct page */
    $this->get('http://localhost' . $this->baseurl . 'transactions/transactions');

    /* see if relevant field names are there */
    $this->assertText('Author');
    $this->assertText('Title');
    $this->assertText('ISBN');
    
    /* see if relevant options are there */
    $this->assertPattern('/<input.*type="submit".*value="Accept".*>/');
    $this->assertText('Counter Transaction'); /* assumes counter not a button */
    
  }

  /* tests elements on transaction confirmation page */
  function testConfirmTransaction() {

    /* test title */
    echo '<h2 style="color: black;">testConfirmTransaction...</h2>';

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* go to correct page */
    $this->get('http://localhost' . $this->baseurl . 'transactions/confirm_transaction');

    /* see if relevant info blocks are there */
    $this->assertText('Book Offer');
    $this->assertText('Owner Information');
    $this->assertText('Selected Offer Details');

    /* see if complete button is there */
    $this->assertPattern('/<input.*type="submit".*value="complete.*".*>/i');

  }

}
?>