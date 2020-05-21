<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 20.05.2020
     * Time: 22:49
     */

    namespace App\Builders;


    use App\Author;
    use App\Book;

    class BookBuilder
    {
        private $title = null;

        private $authors = array();

        private $book;

        public function setTitle($title)
        {
            $this->title = $title;
        }

        public function addAuthor(Author $author)
        {
            $this->authors[] = $author;
        }

        public function save()
        {
            $book = new Book();
            $book->title = $this->title;
            $book->save();
            foreach ($this->authors as $author) {
                $book->author()->attach($author);
            }
            return $book;
        }

    }