<?php
/** 
 * File: app/tests/cases/views/add_books.test.php
 *
 * Tests add books use case, which involves navigating
 * to the add books page, entering in book information,
 * selecting a book from a results page, then entering
 * in desired initial offer information
 */

class AddBooksTestCase extends CakeWebTestCase {

  /* tests navigation to add books page */
  function testAddView() {
    /* setup */
    $this->baseurl = current(split('webroot', $_SERVER['PHP_SELF']));
    debug($this->baseurl . 'books');

    /* from splash page */

    /* from my library page */

  }

  /* tests searching a book and displaying correct results */
  function testFindView() {
    
  }

  /* tests adding initial offer metadata to a book in user's library */
  function testBookInitialOfferView() {
    
  }

}
?>