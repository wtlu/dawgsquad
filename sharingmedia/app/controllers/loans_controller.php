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
                $this->layout = 'main_layout';
                $this->set('title_for_layout', 'Library || My Loans');
	}
}?>
