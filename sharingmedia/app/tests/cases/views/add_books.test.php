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

  /* tests searching a book and displaying correct results 
   * -- look for operating systems book by ISBN */
  function testFindAndInitialOfferView() {

    /* intro message
     * TODO: move this somewhere more appropriate*/
    echo '<p style="border: 1px solid black; background-color: yellow; margin: 10pt; font-size: 14pt;">This tests the use case of a user adding a book to his or her library.</p>';

    /* get the application url */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));

    /* cut off the 'app' suffix and add that stupid 'index.php' thing */
    $this->baseurl = substr($this->baseurl, 0, strrpos($this->baseurl, "app")) . 'index.php/';

    /* all the pages we're concerned about */
    $add_page		= 'http://localhost' . $this->baseurl . 'books/add_books';
    $results_page	= 'http://localhost' . $this->baseurl . 'books/add_books_results';
    $init_offer_page	= 'http://localhost' . $this->baseurl . 'book_initial_offers/initial_offer_details';
    $confirm_page	= 'http://localhost' . $this->baseurl . 'book_initial_offers/add_books_confirm';

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
    $this->click('Add This Book');

    /* make sure on initial offer page */
    $this->assertEqual($this->getUrl(), $init_offer_page);

    /* set up and submit initial offer */
    $this->setFieldById('choose_sell', 'selected'); /* choose sell */
    $this->setFieldById('BookInitialOfferSellPrice', '100'); /* sell for $100 */
    $this->click('Add To MyLibrary');

    /* make sure on results page */
    $this->assertEqual($this->getUrl(), $confirm_page);

  }

}
?>