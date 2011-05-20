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
        5/12/2011 - John Wang - Find book results now works for the most part
        5/13/2011 - John Wang - Commented some more code. Changed add books search to no longer search our db
        5/14/2011 - John Wang - Fixed find books search process. More comments
        5/15/2011 - John Wang - Added multiple pages of search results
-->
<?php

App::import('Sanitize');

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
        	$data['Book']['book_title'] = 'temp';
        	$this->set('data', $data);
        }

        # Function for find books results view. Returns an array of book results to be displayed in the find book results view.
        function find_books_results($book_title = null, $book_author = null, $book_isbn = null) {
                $this->layout = 'main_layout';
                $this->set('title_for_layout', 'find_book_result');
                $book_results = array();
                if (isset($this->data['Book']['title'])) {
                        $book_title = $this->data['Book']['title'];
                }
                if (isset($this->data['Book']['author'])) {
                        $book_author = $this->data['Book']['author'];
                }
                if (isset($this->data['Book']['isbn'])) {
                        $book_isbn = $this->data['Book']['isbn'];
                }
                # DEPRECATED if (!empty($this->data['Book']['title']) || !empty($this->data['Book']['author']) || !empty($this->data['Book']['isbn'])){
                if (!empty($book_title) || !empty($book_author) || !empty($book_isbn)){
                        # query our database to find the book
                        $book_results = $this->Book->query('SELECT DISTINCT books.*, users.*, b_i_o.*
                                FROM books books, book_initial_offers b_i_o, users users, loans loans
	                                WHERE b_i_o.user_id != ' . $this->Session->read('uid') . '
	                                	AND b_i_o.user_id = users.facebook_id
                                        AND b_i_o.book_id = books.id
                                        AND books.title LIKE "%' .$book_title . '%"
                                        AND books.author LIKE "%' . $book_author . '%"
                                        AND books.isbn LIKE "%' .  $book_isbn . '%"
                                ORDER BY books.id;');


                }
                $this->set('book_results', $book_results);
        }

        # Function for the add books results view. Returns an array of Google book results to be displayed in add book
        # results view
        function add_books_results() {
                $this->layout = 'main_layout';
        $this->set('title_for_layout', 'add_book_result');
                $book_title = $this->data['Book']['title'];
                $book_author = $this->data['Book']['author'];
                $book_isbn = $this->data['Book']['isbn'];
                $index = $this->data['Book']['index'];

                /*
                --------Ignore this part for testing or whatever. Not gonna worry about querying our database for now---------
                $book_results = array();
                if (!empty($this->data['Book']['title']) || !empty($this->data['Book']['author']) || !empty($this->data['Book']['isbn'])){
                        # search our database for the book
                        # SQL query to parse our database to find the desired book
                        $book_results = $this->Book->query('SELECT * FROM books
                                WHERE title LIKE "' .$book_title . '"
                                        OR author LIKE "' . $book_author . '"
                                        OR isbn LIKE "' .  $book_isbn . '";');
                        # set book result to send to the add book result view
                }
                $this->set('book_results', $book_results);

                # search google books
                if (empty($book_results)) {
                ----------------------------------------------------------------------------------------
                */

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
                $search_string = $search_string . '&start-index=' . $index . '&max-results=5';

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
                $this->set('book_title', $book_title);
                $this->set('book_author', $book_author);
                $this->set('book_isbn', $book_isbn);
                $this->set('index', $index);
        }

        # helper function for querying Google books search. Returns the full array of results from Google books search
        # Pre-condition: user has entered some search value. Otherwise, we just return empty result
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

        # helper function to filter the relevant data of the google book search and put that in book_results
        # Pre-condition: assumes that Google search has returned values
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
                } else if (array_key_exists('Creator', $result)) {
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

