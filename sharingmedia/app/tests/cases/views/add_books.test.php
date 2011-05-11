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
    $init_page = 'http://localhost/dawgsquad/sharingmedia/';
    $final_page = 'http://localhost/dawgsquad/sharingmedia/index.php/books/add_books';

    /* on splash page */
    $this->get($init_page);

    /* go to add books page */
    $this->clickLinkById('add_book_link');

    /* make sure on add books page */
    $this->assertEqual($this->getUrl(), $final_page);
  }

  /* tests searching a book and displaying correct results 
   * -- look for operating systems book by ISBN */
  function testFindView() {
    /* setup */
    $init_page = 'http://localhost/dawgsquad/sharingmedia/index.php/books/add_books';
    $final_page = 'http://localhost/dawgsquad/sharingmedia/index.php/books/add_books_results';

    /* on find page */
    $this->get($init_page);
    
    /* fill out form */
    $this->setField('data[Book][isbn]', '978-0-470-12872-5');

    /* click submit --> go to results page */
    $this->click('Continue');

    /* make sure on results page */
    $this->assertEqual($this->getUrl(), $final_page);

    /* check if our book is on the page */
    $this->assertText('Operating system concepts');				/* title */
    $this->assertText('Abraham Silberschatz, Peter B. Galvin, Greg Gagne');	/* authors */
  }

  /* tests adding initial offer metadata to a book in user's library */
  function testBookInitialOfferView() {
    
  }

}
?>