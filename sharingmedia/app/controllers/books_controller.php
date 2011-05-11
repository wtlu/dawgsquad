<!-- File: /app/controllers/book_controller.php -->

<!--
	Created: 5/7/2011
	Author: John Wang

	Changelog:
	5/7/2011 - John Wang - Created page, wrote add_books_results to pull data from our db
	5/8/2011 - John Wang - Added functionality to query Google books and return those results
	5/9/2011 - John Wang - Handles more cases from querying Google books
	5/10/2011 - John Wang -
-->

<?php
class BooksController extends AppController {
	var $name = 'Books';

	function add_books() {
		$this->layout = 'main_layout';
        $this->set('title_for_layout', 'add_a_book');
	}

	function find_books() {

	}

	function find_books_results() {

	}

	function add_books_results() {
		$this->layout = 'main_layout';
        $this->set('title_for_layout', 'add_book_result');
		if (!empty($this->data)) {
			$book_title = $this->data['Book']['title'];
			$book_author = $this->data['Book']['author'];
			$book_isbn = $this->data['Book']['isbn'];
			$book_results = $this->Book->query('SELECT * FROM books WHERE title LIKE "%' . $book_title . '%" AND author LIKE "%' . $book_author . '%" AND isbn LIKE "%' .  $book_isbn . '%";');
			$this->set('book_results', $book_results);
			# debug($book_results);
		}
		# search google books
		if (empty($book_results)) {
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

			#get just the relevant portions of google book search and put that in book_results
			if (empty($google_results)) {

			} else if (!array_key_exists(0, $google_results)) {
				# case when there is only 1 book result
				$google_books_results = array_merge($google_books_results, $this->get_relevant_data($google_results));
			} else {
				foreach ($google_results as $result){
					$google_books_results = array_merge($google_books_results, $this->get_relevant_data($result));
				}
			}

			$this->set('google_books_results', $google_books_results);
		}
	}

	function query_google($search_val) {
		App::import('HttpSocket');
		App::import('Xml');
		$http = new HttpSocket();
		$url = 'http://books.google.com/books/feeds/volumes';
		$results = & new Xml($http->get($url, $search_val));
		$results = Set::reverse($results);

		#debug($results);

		$google_results = array();

		if ($results['Feed']['totalResults'] > 0) {
			$google_results = $results['Feed']['Entry'];
		} else {

		}
		return $google_results;
	}

	#helper function to get the relevant data of google book search and put that in book_results
	function get_relevant_data($result) {
		$title = $result['Title'][1];
		# check to see if this book has a second title and add it
		if (array_key_exists(2, $result['Title'])) {
			$title = $title . ': ' . $result['Title'][2];
		}
		$author = '';
		if (array_key_exists('creator', $result)) {
			$author = $result['creator'];
		} else {
			$author = $result['Creator'][0];
			for ($i = 1; $i < count($result['Creator']); $i++) {
				$author = $author . ', '. $result['Creator'][$i];
			}
		}
		$ISBN = $result['Identifier'][1];
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