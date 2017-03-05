<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller {

    /**
    * GET /books
    */
    public function index() {
        return 'Here are all the books...';
    }

    /**
    * GET /book/{title}
    */
    public function title($title = '') {

        if($title == '') {
            return 'Your request did not include a title.';
        }
        else {
            return 'Results for the book: '.$title;
        }

    }
}
