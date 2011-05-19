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
	    //pull books and initial offers from the databaxe
		$book_collection = $this->Loan->query("SELECT * FROM books, loans WHERE books.id = loans.book_id AND owner_id = ".$this->Session->read('uid'));
		//pass variables to page
		$this->set('book_collection', $book_collection);
	    // query database for users loans
	    $loan_collection = $this->Loan->query("SELECT * FROM loans WHERE owner_id = ". $this->Session->read('uid'));
		// pass variables to the view
		$this->set('loan_collection', $loan_collection);
	    
	}
	
	function remove_confirm(){
		
	}
	
	function complete_loan(){
		
	}
}?>
