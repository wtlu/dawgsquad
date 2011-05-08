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

	function queryGoogle() {

	}

	function add_books_results() {
		if (!empty($this->data)) {
			$book_title = $this->data['Book']['title'];
			$book_author = $this->data['Book']['author'];
			$book_isbn = $this->data['Book']['isbn'];
			$book_results = $this->Book->query('SELECT * FROM books WHERE title LIKE "%' . $book_title . '%" AND author LIKE "%' . $book_author . '%" AND isbn LIKE "%' .  $book_isbn . '%";');
			$this->set('book_results', $book_results);
		}
		$this->set('search_title', $book_title);
		$this->set('search_author', $book_author);
		$this->set('search_isbn', $book_isbn);
	}
}
?>