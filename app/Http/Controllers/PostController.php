<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $posts = Post::all();
        return response()->json( $posts );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create( Request $request ) {
        $post = new Post( [
            'content' => $request->input( 'content' ),
            'user_id' => $request->input( 'user_id' )
        ] );
        $post->save();

        return response()->json( 'The book successfully added' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        // $post = new Post( [
        //     'content' => $request->get( 'content' ),
        //     'user_id' => $request->get( 'user_id' )
        // ] );

        // $post->save();
        // return response()->json( 'Successfully added' );
        // Validate the request
        // Validate the request
        $request->validate( [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id'  // Validate that the user exists
        ] );

        // Find the user by user_id from the request
        $user = User::find( $request->input( 'user_id' ) );

        // Create the post and associate it with the user
        $post = new Post();
        $post->title = $request->input( 'title' );
        $post->content = $request->input( 'content' );
        $post->user_id = $user->id;
        // Associate the post with the user's ID
            $post->save();
    
            return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
        // dd( $request->all() );
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $post = Post::find( $id );
        return response()->json( $post );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $post = Post::find( $id );
        $post->update( $request->all() );

        return response()->json( 'The book successfully updated' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $post = Post::find( $id );
        $post->delete();

        return response()->json( 'The book successfully deleted' );
    }

    public function getPostsByAuthor( $userId ) {
        $posts = Post::where( 'user_id', $userId )->get();
        return response()->json( $posts );
    }

    public function store2( Request $request ) {
        // Validate the request
        $request->validate( [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'username' => 'required|string'  // Accept username from frontend
        ] );

        // Find user by username
        $user = User::where( 'name', $request->input( 'username' ) )->first();

        if ( !$user ) {
            return response()->json( [ 'error' => 'User not found' ], 404 );
        }

        // Create the post and associate it with the user
        $post = new Post();
        $post->title = $request->input( 'title' );
        $post->content = $request->input( 'content' );
        $post->user_id = $user->id;
        // Associate post with the user

        $post->save();

        return response()->json( [ 'message' => 'Post created successfully!', 'post' => $post ], 201 );
    }
}