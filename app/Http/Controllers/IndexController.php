<?php

    namespace App\Http\Controllers;

    use App\Author;
    use App\Book;
    use App\Builders\BookBuilder;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class IndexController extends Controller
    {
        //
        public function authors(Request $request)
        {
            $authors = Author::select(['*'])->paginate(5);

            return view('author_create')->with(['authors' => $authors]);
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
            $books = Book::select(['*'])->paginate(5);

            return view('book_create')->with(['authors' => $authors, 'books' => $books]);
        }

        public function store_book(Request $request)
        {
            $validatedData = $request->validate([
                    'title' => 'required',
            ]);

            $bookBuilder = new BookBuilder();
            $bookBuilder->setTitle($request->title);
            if ($request->has('authors')) {
                foreach ($request->authors as $item) {
                    $author = Author::get($item);
                    if ($author != null) {
                        $bookBuilder->addAuthor($author);
                    }
                }
            }
            $bookBuilder->save();

            return redirect('/books');
        }

        public function seach(Request $request)
        {
            return view('search');
        }

        public function searchBook(Request $request)
        {

            if (!isset($request->seach)) {
                return response()->json(['']);
            }
            $seach = $request->seach;

            $books = null;
            $books = DB::table('books');

            $books->leftJoin('book_author', 'book_author.book_id', '=',
                    'books.id');

            $authors = Author::select('*')->where('first_name', 'like', "%" . $seach . "%")->orWhere('last_name',
                    'like', "%" . $seach . "%")->get();

            $authors_array = array();
            foreach ($authors as $author) {
                array_push($authors_array, $author->id);
            }

            $books->whereIn('book_author.author_id', $authors_array);
            $books->orWhere('books.title', 'like', "%" . $seach . "%");

            $books->select('books.*');
            $books = $books->get();

            $seach_arry = array();

            foreach ($books as $book) {
                $bookItem = Book::get($book->id);
                $authors = $bookItem->author()->get();
                $item = array('book' => $bookItem, 'authors' => $authors);
                array_push($seach_arry, $item);
            }
            $seach_arry = array_unique($seach_arry, SORT_REGULAR);

            return response()->json([
                    'books' => $seach_arry,
            ]);

        }
    }
