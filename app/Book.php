<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $table="Book";



    public function author()
    {
        return $this->belongsToMany('App\Author', 'book_author', 'book_id',
                'author_id');
    }
}
