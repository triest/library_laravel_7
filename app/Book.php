<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Book extends Model
    {
        //
        protected $table = "Books";


        public function author()
        {
            return $this->belongsToMany('App\Author', 'book_author', 'book_id',
                    'author_id');
        }

        public static function get($id)
        {
            return Book::select(['*'])->where('id', $id)->first();
        }
    }
