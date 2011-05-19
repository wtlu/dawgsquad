<!--
        Created: 5/13/2011
        Author: Ken Inoue

        Changelog:
	5/13/2011 Ken Inoue added my_loan function
	5/19/2011 Troy Martin: Actually implemented my_loan function and everything else
-->

<?php
class LoansController extends AppController {
	var $helpers = array ('HTML', 'Form', 'Session', 'Facebook.Facebook');
	var $name = 'Loans';
	
	// PRE: Called from my library
	// POST: Display the users current loans
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
		for ($i = 0; $i < count($loan_collection); $i++){
			$client_id = $loan_collection[$i]["loans"]["client_id"];
			$client_name = $this->Loan->query("SELECT name FROM users WHERE facebook_id = " . $client_id);
			$loan_collection[$i]["loans"]["client_id"] = $client_name[0]["users"]["name"];
		}
		$this->set('loan_collection', $loan_collection);
	    
	}
	
	// PRE: Transfered here from my library if user selects "complete loan". Each book can only be loaned once, in other words, no duplicates.
	// POST: Transfer control to a confirmation page
	function complete_loan($book_id, $due_date){
		// set up layout
	    $this->layout = 'main_layout';
	    $this->set('title_for_layout', 'Library || My Loans');
	    // query stuff
	    $client_id_array = $this->Loan->query("SELECT client_id FROM loans WHERE owner_id = " . $this->Session->read('uid') . " AND book_id = " . $book_id);
	    $client_id = $client_id_array[0]["loans"]["client_id"];
	    $client_name_array = $this->Loan->query("SELECT name FROM users WHERE facebook_id = " . $client_id);
	    $client_name = $client_name_array[0]["users"]["name"];
	    $book_info = $this->Loan->query("SELECT * FROM books WHERE id = " . $book_id);
	    //pass parameters
	    $this->set('book_info', $book_info);
	    $this->set('client_name', $client_name);
	    $this->set('due_date', $due_date);
	}
	
	// PRE: Transfered here if user confirmed they wanted to complete a loan.
	// POST: Removes the tuple corresponding to the loan from the loans table.
	function remove_loan($book_id, $owner_id){
		// set up layout
	    $this->layout = 'main_layout';
	    $this->set('title_for_layout', 'Library || My Loans');
	    // remove tuple from loan table
	    $this->Loan->query("DELETE FROM loans WHERE owner_id = " . $owner_id . " AND book_id = " . $book_id);		
	}
}?>
