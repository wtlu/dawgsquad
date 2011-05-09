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
		}
		$search_string = 'q=isbn:' . $book_isbn . '+intitle:' . $book_title . '+inauthor:' . $book_author . '&num=10';
		if (empty($book_results)) {
			$google_results = $this->query_google($search_string);
			$this->set('google_results', $google_results);
		}
	}

	function query_google($search_val) {
		App::import('HttpSocket');
		App::import('Xml');
		$http = new HttpSocket();
		$url = 'http://books.google.com/books/feeds/volumes';
		$results = $http->get($url, $search_val);
		return $results;
	}
}
?>