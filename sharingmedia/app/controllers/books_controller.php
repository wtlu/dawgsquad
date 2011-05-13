<!--
File: /app/controllers/books_controller.php

	Created: 5/7/2011
	Author: John Wang

	Changelog:
	5/7/2011 - John Wang - Created page, wrote add_books_results to pull data from our db
	5/8/2011 - John Wang - Added functionality to query Google books and return those results
	5/9/2011 - John Wang - Handles more cases from querying Google books
	5/10/2011 - John Wang - Started controller for find books
	5/11/2011 - John Wang - Continue work on find books results
-->
<?php
class BooksController extends AppController {
	var $name = 'Books';

	# The function for the add books view
	function add_books() {
		$this->layout = 'main_layout';
        $this->set('title_for_layout', 'add_a_book');
	}

	# Function for the find books view
	function find_books() {
		$this->layout = 'main_layout';
        $this->set('title_for_layout', 'find_a_book');
	}

	# Function for find books results view
	function find_books_results() {
		$this->layout = 'main_layout';
		$this->set('title_for_layout', 'find_book_result');
		if (!empty($this->data)) {
			$book_title = $this->data['Book']['title'];
			$book_author = $this->data['Book']['author'];
			$book_isbn = $this->data['Book']['isbn'];
			$book_results = $this->Book->query('SELECT DISTINCT books.*, users.*, b_i_o.*
				FROM books books, book_initial_offers b_i_o, users users
				WHERE b_i_o.user_id = users.facebook_id
					AND b_i_o.book_id = books.id
					AND books.title LIKE "%' .$book_title . '%"
					AND books.author LIKE "%' . $book_author . '%"
					AND books.isbn LIKE "%' .  $book_isbn . '%"
				ORDER BY books.id;');
			$trades_results = $this->Book->query('SELECT DISTINCT trades.*
				FROM book_initial_offers b_i_o, trades trades
				WHERE b_i_o.trade_id = trades.id
				ORDER BY trades.id');
			$this->set('trade_results', $trades_results);
			$this->set('book_results', $book_results);
			debug($book_results);
			debug($trades_results);
		}
	}

	# Function for the add books results view
	function add_books_results() {
		$this->layout = 'main_layout';
        $this->set('title_for_layout', 'add_book_result');

        # search our database for the book
		$book_title = $this->data['Book']['title'];
		$book_author = $this->data['Book']['author'];
		$book_isbn = $this->data['Book']['isbn'];
		# SQL query to parse our database to find the desired book
		$book_results = $this->Book->query('SELECT * FROM books
			WHERE title LIKE "%' .$book_title . '%"
				AND author LIKE "%' . $book_author . '%"
				AND isbn LIKE "%' .  $book_isbn . '%";');
		# set book result to send to the add book result view
		$this->set('book_results', $book_results);

		# search google books
		if (empty($book_results)) {
			# build the search string to send to Google books
			$search_string = 'q=';
			if (!empty($book_isbn)) {
				$search_string = $search_string . 'isbn:' . $book_isbn;
			}
			if (!empty($book_title)) {
				$book_title = str_replace(" ", "+intitle:", $book_title);
				$search_string = $search_string . '+intitle:' . $book_title;
			}
			if (!empty($book_author)) {
				$book_author = str_replace(" ", "+inauthor:", $book_author);
				$search_string = $search_string . '+inauthor:' . $book_author;
			}
			$search_string = $search_string . '&num=10';

			#these are the book results returned by google book search
			$google_results = $this->query_google($search_string);
			$google_books_results = array();

			#get just the relevant portions of google book search and put that in the final google_books_results
			if (empty($google_results)) {

			} else if (!array_key_exists(0, $google_results)) {
				# case when there is only 1 book result
				$google_books_results = array_merge($google_books_results, $this->get_relevant_data($google_results));
			} else {
				foreach ($google_results as $result){
					$google_books_results = array_merge($google_books_results, $this->get_relevant_data($result));
				}
			}

			# set google books result to send to the add book result view
			$this->set('google_books_results', $google_books_results);
		}
	}

	# helper function for querying Google books search
	function query_google($search_val) {
		App::import('HttpSocket');
		App::import('Xml');
		$http = new HttpSocket();
		$url = 'http://books.google.com/books/feeds/volumes';
		$results = & new Xml($http->get($url, $search_val));
		$results = Set::reverse($results);

		$google_results = array();

		if ($results['Feed']['totalResults'] > 0) {
			$google_results = $results['Feed']['Entry'];
		}

		return $google_results;
	}

	# helper function to get the relevant data of google book search and put that in book_results
	function get_relevant_data($result) {
		$title = $result['Title'][1];
		# check to see if this book has a second title and add it
		if (array_key_exists(2, $result['Title'])) {
			$title = $title . ': ' . $result['Title'][2];
		}
		$author = '';
		# check to see if this book has multiple authors
		if (array_key_exists('creator', $result)) {
			$author = $result['creator'];
		} else {
			$author = $result['Creator'][0];
			for ($i = 1; $i < count($result['Creator']); $i++) {
				$author = $author . ', '. $result['Creator'][$i];
			}
		}
		$ISBN = str_replace('ISBN:', '', $result['Identifier'][1]);
		# check to see if this book result has an image, and if not, replace with generic thumbnail
		if ($result['Link'][0]['type'] == 'image/x-unknown') {
			$image = $result['Link'][0]['href'];
			$image = str_replace('zoom=5', 'zoom=1', $image);
		} else {
			$image = 'http://books.google.com/googlebooks/images/no_cover_thumb.gif';
		}
		$summary = '';
		if (array_key_exists('description', $result)) {
			$summary = $result['description'];
		}

		$relevant_stuff = array('title' => $title, 'author' => $author,
			'ISBN' => $ISBN, 'image' => $image, 'summary' => $summary);

		$book_sub = array($relevant_stuff);
		return $book_sub;
	}
}
?>