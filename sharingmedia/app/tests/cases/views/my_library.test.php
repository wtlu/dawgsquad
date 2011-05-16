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

    /* setup */
    $this->baseurl = current(split("webroot", $_SERVER['PHP_SELF']));
    debug($this->baseurl);
  }

}
?>
