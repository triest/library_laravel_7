<?php

    namespace App\Http\Controllers;

    use App\Author;
    use App\Book;
    use Illuminate\Http\Request;

    class IndexController extends Controller
    {
        //
        public function authors(Request $request)
        {
            return view('author_create');
        }

        public function store_author(Request $request)
        {
            $validatedData = $request->validate([
                    'last_name' => 'required',
                    'first_name' => 'required',
            ]);

            $author = new Author();
            $author->first_name = $request->first_name;
            $author->last_name = $request->last_name;
            $author->save();
            return redirect('/authors');
        }

        public function books()
        {
            $authors = Author::select(['*'])->get();

            return view('book_create')->with(['authors' => $authors]);
        }

        public function store_book(Request $request)
        {
            $validatedData = $request->validate([
                    'title' => 'required',
            ]);

            $book = new Book();
            $book->title = $request->title;
            $book->save();

            if ($request->has('authors')) {
                foreach ($request->authors as $item) {
                    $target = Author::select(['id', 'first_name'])->where('id', $item)
                            ->first();
                    if ($target != null) {
                        $book->author()->attach($target);
                    }
                }
            }

            return redirect('/books');
        }
    }
