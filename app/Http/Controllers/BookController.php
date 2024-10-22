<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\author;

class BookController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {

        $books = Book::all()->toArray();
        return array_reverse( $books );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function add( Request $request ) {
        $book = new Book( [
            'name' => $request->input( 'name' ),
            'author' => $request->input( 'author' )
        ] );
        $book->save();

        return response()->json( 'The book successfully added' );
    }

    /**
    * Display the specified resource.
    */

    public function show( Book $book ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( $id ) {

        $book = Book::find( $id );
        return response()->json( $book );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, $id ) {
        $book = Book::find( $id );
        $book->update( $request->all() );

        return response()->json( 'The book successfully updated' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function delete( $id ) {
        $book = Book::find( $id );
        $book->delete();

        return response()->json( 'The book successfully deleted' );
    }

    public function getPostsByAuthor( $authorId ) {
        $books = Book::where( 'author_id', $authorId )->get();
        return response()->json( $books );
    }
}