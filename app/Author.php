<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Author extends Model
    {
        //
        protected $table = "authors";

        public function author()
        {
            return $this->belongsToMany('App\Books', 'book_author', 'author_id',
                    'book_id');
        }
    }
