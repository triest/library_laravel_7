<?php

    namespace App\Http\Controllers;

    use App\Author;
    use App\Book;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

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

        public function seach(Request $request)
        {
            return view('seach');
        }

        public function searchBook(Request $request)
        {

            if (!isset($request->seach)) {
                return response()->json(['']);
            }
            $seach = $request->seach;

            $books = null;
            $books = DB::table('book_author');

            $books->leftJoin('books', 'book_author.book_id', '=',
                    'books.id');


            $books->leftJoin('authors', 'book_author.author_id', '=',
                    'authors.id');


         //   $books->where('books.title', 'like', "%" . $seach . "%");

            $books->orWhere('authors.first_name', 'like', "%" . $seach . "%");
            $books->orWhere('authors.last_name', 'like', "%" . $seach . "%");
            $books->select('*');

            $books = $books->get();

            $seach_arry = array();

            foreach ($books as $book) {
                $bookItem = Book::get($book->id);
                $authors = $bookItem->author()->get();
                $item = array('book' => $bookItem, 'authors' => $authors);
                array_push($seach_arry, $item);
            }

            return response()->json([
                    'books' => $seach_arry,
            ]);

        }
    }
