<?php
class BooksController extends AppController {
	var $name = 'Books';

	function add_books() {

	}

	function addBook() {

	}

	function deleteBook() {

	}

	function editBook() {

	}

	function showBook($id) {

	}

	function add_books_results() {
		if (!empty($this->data)) {
			$book_title = $this->data['Book']['title'];
			$book_author = $this->data['Book']['author'];
			$book_isbn = $this->data['Book']['isbn'];
			$book_results = $this->Book->query('SELECT * FROM books WHERE title LIKE "%' . $book_title . '%" AND author LIKE "%' . $book_author . '%" AND isbn LIKE "%' .  $book_isbn . '%";');
			$this->set('book_results', $book_results);
			# debug($book_results);
		}
		if (empty($book_results)) {
			$search_string = 'q=';
			if (!empty($book_isbn)) {
				$search_string = $search_string . 'isbn:' . $book_isbn;
			}
			if (!empty($book_title)) {
				$search_string = $search_string . '+intitle:' . $book_title;
			}
			if (!empty($book_author)) {
				$search_string = $search_string . '+inauthor:' . $book_author;
			}
			$search_string = $search_string . '&num=10';
			$google_results = $this->query_google($search_string);
			$this->set('google_results', $google_results);
		}
	}

	function query_google($search_val) {
		App::import('HttpSocket');
		App::import('Xml');
		$http = new HttpSocket();
		$url = 'http://books.google.com/books/feeds/volumes';
		$results = & new Xml($http->get($url, $search_val));
		$results = Set::reverse($results);
		if (!empty($results)) {
			#these are relevant book results returned by google book search
			$google_results = $results['Feed']['Entry'];
		}

		# debug($entries);
		return $entries;
	}
}
?>