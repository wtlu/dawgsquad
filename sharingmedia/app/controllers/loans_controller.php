<!--
        Created: 5/13/2011
        Author: Ken Inoue

        Changelog:
	5/13/2011 Ken Inoue created added my_loan function
-->

<?php
class LoansController extends AppController {
   var $name = 'Loans';

	function my_loans(){
		// set up layout
	    $this->layout = 'main_layout';
	    $this->set('title_for_layout', 'Library || My Loans');
	    
	    // query database for users loans
	    $loan_collection = $this->Loan->query("SELECT * FROM loans, WHERE owner_id = ". $this->Session->read('uid'));
		//pass variables to page
		debug($loan_collection);
		//$this->set('book_collection', $book_collection);
	    
	}
}?>
