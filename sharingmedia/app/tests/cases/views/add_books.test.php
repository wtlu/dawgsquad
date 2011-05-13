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

    /* TODO: LOGIN TO DUMMY FACEBOOK ACCOUNT
     *  - NOTE: THIS TEST WILL FAIL 
     *  - this is deferred until login is working and documented */

    /* on splash page */
    $this->get($init_page);

    /* go to add books page */
    $this->clickLinkById('add_book_link');

    /* make sure on add books page */
    $this->assertEqual($this->getUrl(), $final_page);
  }

  /* tests searching a book and displaying correct results 
   * -- look for operating systems book by ISBN */
  function testFindAndInitialOfferView() {
    /* setup */
    $add_page		= 'http://localhost/dawgsquad/sharingmedia/index.php/books/add_books';
    $results_page	= 'http://localhost/dawgsquad/sharingmedia/index.php/books/add_books_results';
    $init_offer_page	= 'http://localhost/dawgsquad/sharingmedia/index.php/book_initial_offers/initial_offer_details';
    $confirm_page	= 'http://localhost/dawgsquad/sharingmedia/index.php/book_initial_offers/add_books_confirm';

    /* on find page */
    $this->get($add_page);
    
    /* fill out form */
    $this->setFieldById('BookIsbn', '978-0-470-12872-5');

    /* click submit --> go to results page */
    $this->click('Continue');

    /* make sure on results page */
    $this->assertEqual($this->getUrl(), $results_page);

    /* check if our book is on the page */
    $this->assertText('Operating system concepts');				/* title */
    $this->assertText('Abraham Silberschatz, Peter B. Galvin, Greg Gagne');	/* authors */

    /* now select a book (doesn't matter what one necessarily...) */
    $this->setFieldById('choose_book', 'selected');
    $this->click('Continue');

    /* make sure on initial offer page */
    $this->assertEqual($this->getUrl(), $init_offer_page);

    /* set up and submit initial offer */
    $this->setFieldById('choose_sell', 'selected'); /* choose sell */
    $this->setFieldById('BookInitialOfferSellPrice', '100'); /* sell for $100 */
    $this->click('Add To MyLibrary');

    /* make sure on results page */
    $this->assertEqual($this->getUrl(), $confirm_page);

    /* check data
     * TODO: find out what to display... no format yet */
  }

}
?>