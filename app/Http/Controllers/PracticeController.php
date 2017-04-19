<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rych\Random\Random;
use App\Book;

class PracticeController extends Controller {

    public function practice13() {

        $books = Book::where('author', '=', 'J.K. Rowling')->get();

        if ($books->isEmpty()) {
            dump("did not delete; no books found");
        } else {
            foreach($books as $book) {
                $book->delete();
                dump("book deleted");
            }
        }

    }

    public function practice12() {

        $books = Book::where('author', '=', 'Bell Hooks')->get();

        if ($books->isEmpty()) {
            dump("no books found");
        } else {
            foreach($books as $book) {
                $book->author = 'bell hooks';
                $book->save;
            }
            dump("changes saved");
        }
    }

    public function practice11() {

        $books = Book::orderBy('published', 'desc')->get();
        dump($books->toArray());
    }

    public function practice10() {

        $books = Book::orderBy('title')->get();
        dump($books->toArray());

    }

    public function practice9() {

        $books = Book::where('published', '>', '1950')->get();
        dump($books->toArray());

    }

    public function practice8() {

        $books = Book::orderBy('created_at', 'desc')->limit(5)->get();
        dump($books->toArray());

    }

    public function practice7() {

        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->get();

        if($books->isEmpty()) {
            dump('No matches found');
        }
        else {
            foreach($books as $book) {
                dump($book->title);
            }
        }
    }

    public function practice6() {

        # Instantiate a new Book Model object
        $book = new Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = "Harry Potter and the Sorcerer's Stone";
        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump('Added: '.$book->title);
    }

    public function practice5() {
        $lettersArray = [
            'letter1' => ['A', "doubleletter"],
            'letter2' => ['B', "doubleletter"],
            'letter3' => ['C', "doubleletter"]
        ];
        $attribute = "letter1.1";
        $value = "doubleletter";

        if ($value != "none" && $value != null) {
            $i=1;
            foreach ($lettersArray as $letterNumber => $wordLetter) {
                dump($i);
                dump($letterNumber.".1");
                if ($letterNumber.".1" == $attribute) {
                    echo "attribute matches ".$letterNumber."<br />";
                    if (isset($lettersArray["letter".($i-1)][1])) {
                        echo "previous key exists<br />";
                        if ($lettersArray["letter".($i-1)][1] != "none") {
                            echo "previous key has bonus<br />";
                            return false;
                        }
                    }
                    if (isset($lettersArray["letter".($i+1)][1])) {
                        echo "next key exists<br />";
                        if ($lettersArray["letter".($i+1)][1] != "none") {
                            echo "next key has bonus<br />";
                            return false;
                        } else {
                            echo "no bonus on previous or next<br />";
                            return "true";
                        }
                    } else {
                        echo "no bonus on previous, next doesn't exist<br />";
                        return true;
                    }
                }
                $i++;
            }
        } else {
            echo "no bonus on attribute<br />";
            return true;
        }
    }

    public function practice4() {
        $practiceArray = [
            "letter1" => ["A", "tripleword"],
            "letter2" => ["B", ""],
            "letter3" => ["C", ""],
            "letter4" => ["D", "none"],
            "letter5" => ["E", "tripleletter"]
        ];
        $i=1;
        foreach ($practiceArray as $letterNumber => $wordLetter) {
            dump($i);
            if ($wordLetter[1] != "none" && $wordLetter[1] != null) {
                if (array_key_exists("letter".($i-1), $practiceArray)) {
                    if ($practiceArray["letter".($i-1)][1] != "none" &&
                    $practiceArray["letter".($i-1)][1] != null) {
                        return false;
                        }
                }
                if (array_key_exists("letter".($i+1), $practiceArray)) {
                    if ($practiceArray["letter".($i+1)][1] != "none" &&
                    $practiceArray["letter".($i+1)][1] != null) {
                        return false;
                    }
                }
                if ($wordLetter[1] == "doubleletter") {
                    foreach ($practiceArray as $letterNumber => $wordLetter) {
                        if ($wordLetter[1] == "tripleletter") {
                            return false;
                        }
                    }
                } elseif ($wordLetter[1] == "tripleletter") {
                    if (array_key_exists("letter".($i-2), $practiceArray)) {
                        if ($practiceArray["letter".($i-2)][1] != "none" &&
                        $practiceArray["letter".($i-2)][1] != null) {
                            return false;
                        }
                    }
                    if (array_key_exists("letter".($i+2), $practiceArray)) {
                        if ($practiceArray["letter".($i+2)][1] != "none" &&
                        $practiceArray["letter".($i+2)][1] != null) {
                            return false;
                        }
                    }
                    if (array_key_exists("letter".($i-3), $practiceArray)) {
                        if ($practiceArray["letter".($i-3)][1] != "none" &&
                        $practiceArray["letter".($i-3)][1] != null) {
                            return false;
                        }
                    }
                    if (array_key_exists("letter".($i+3), $practiceArray)) {
                        if ($practiceArray["letter".($i+3)][1] != "none" &&
                         $practiceArray["letter".($i+3)][1] != null) {
                            return false;
                        }
                    }
                    foreach ($practiceArray as $letterNumber => $wordLetter) {
                        if ($wordLetter[1] == "doubleletter" ||
                        $wordLetter[1] == "tripleword") {
                            return false;
                        }
                    }
                } elseif ($wordLetter[1] == "doubleword") {
                    if (array_key_exists("letter".($i-2), $practiceArray)) {
                        if ($practiceArray["letter".($i-2)][1] != "none" &&
                        $practiceArray["letter".($i-2)][1] != null) {
                            return false;
                        }
                    }
                    if (array_key_exists("letter".($i+2), $practiceArray)) {
                        if ($practiceArray["letter".($i+2)][1] != "none" &&
                        $practiceArray["letter".($i+2)][1] != null) {
                            return false;
                        }
                    }
                } elseif ($wordLetter[1] == "tripleword") {
                    if (array_key_exists("letter".($i-2), $practiceArray)) {
                        if ($practiceArray["letter".($i-2)][1] != "none" &&
                        $practiceArray["letter".($i-2)][1] != null) {
                            return false;
                        }
                    }
                    if (array_key_exists("letter".($i+2), $practiceArray)) {
                        if ($practiceArray["letter".($i+2)][1] != "none" &&
                        $practiceArray["letter".($i+2)][1] != null) {
                            return false;
                        }
                    }
                    foreach ($practiceArray as $letterNumber => $wordLetter) {
                        if ($wordLetter[1] == "tripleletter") {
                            return false;
                        }
                    }
                }
            } else {
                echo $letterNumber." does not have a bonus<br />";
            }
            $i++;
        }
    }


    /**
    *
    */
    public function practice3() {

        $random = new Random();

        // Generate a 16-byte string of random raw data
        $randomBytes = $random->getRandomBytes(16);
        dump($randomBytes);

        // Get a random integer between 1 and 100
        $randomNumber = $random->getRandomInteger(1, 100);
        dump($randomNumber);

        // Get a random 8-character string using the
        // character set A-Za-z0-9./
        $randomString = $random->getRandomString(8);
        dump($randomString);
    }

    /**
	*
	*/
    public function practice2() {

        dump(config('app'));

    }



    /**
	*
	*/
    public function practice1() {
        dump('This is the first example.');
    }


    /**
	* ANY (GET/POST/PUT/DELETE)
    * /practice/{n?}
    *
    * This method accepts all requests to /practice/ and
    * invokes the appropriate method.
    *
    * http://foobooks.loc/practice/1 => Invokes practice1
    * http://foobooks.loc/practice/5 => Invokes practice5
    * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
	*/
    public function index($n) {



        $method = 'practice'.$n;

        if(method_exists($this, $method))
            return $this->$method();
        else
            dd("Practice route [{$n}] not defined");

    }
}
