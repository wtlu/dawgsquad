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
	    //pull books and initial offers from the database
		$book_collection_owner = $this->Loan->query("SELECT * FROM books, loans WHERE books.id = loans.book_id AND owner_id = ".$this->Session->read('uid'));
		$book_collection_borrower = $this->Loan->query("SELECT * FROM books, loans WHERE books.id = loans.book_id AND client_id = ".$this->Session->read('uid')); 
		$this->set('book_collection_owner', $book_collection_owner);
		$this->set('book_collection_borrower', $book_collection_borrower);
	    $loan_collection_owner = $this->Loan->query("SELECT * FROM loans WHERE owner_id = ". $this->Session->read('uid'));
	    $loan_collection_borrower = $this->Loan->query("SELECT * FROM loans WHERE client_id = ". $this->Session->read('uid'));
		for ($i = 0; $i < count($loan_collection_owner); $i++){
			$client_id = $loan_collection_owner[$i]["loans"]["client_id"];
			$client_name = $this->Loan->query("SELECT name FROM users WHERE facebook_id = " . $client_id);
			$loan_collection_owner[$i]["loans"]["client_id"] = $client_name[0]["users"]["name"];
		}
		
		for ($i = 0; $i < count($loan_collection_borrower); $i++){
			$owner_id = $loan_collection_borrower[$i]["loans"]["owner_id"];
			$owner_name = $this->Loan->query("SELECT name FROM users WHERE facebook_id = " . $owner_id);
			$loan_collection_borrower[$i]["loans"]["owner_id"] = $owner_name[0]["users"]["name"];
		}
			
		$this->set('loan_collection_owner', $loan_collection_owner);
		$this->set('loan_collection_borrower', $loan_collection_borrower);
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
    	$this->set('name', $client_name);
	    $book_info = $this->Loan->query("SELECT * FROM books WHERE id = " . $book_id);
	    //pass parameters
	    $this->set('book_info', $book_info);
	    $this->set('due_date', $due_date);
	}
	
	// PRE: Transfered here if user confirmed they wanted to complete a loan.
	// POST: Removes the tuple corresponding to the loan from the loans table.
	function remove_loan($book_id, $id){
		// set up layout
	    $this->layout = 'main_layout';
	    $this->set('title_for_layout', 'Library || My Loans');
	    
	    $this->Loan->query("DELETE FROM loans WHERE owner_id = " . $id . " AND book_id = " . $book_id);

	}
}?>
