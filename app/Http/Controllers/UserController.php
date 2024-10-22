<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    public function index() {
        return User::all();
    }

    public function index2() {
        $users = User::with( 'posts' )->get();
        return response()->json( $users );
    }

    public function updatePost( Request $request, $id ) {
        $post = Post::findOrFail( $id );
        $post->update( $request->all() );
        return response()->json( $post );
    }

    // Delete a post

    public function deletePost( $id ) {
        $post = Post::findOrFail( $id );
        $post->delete();
        return response()->json( [ 'message' => 'Post deleted successfully' ] );
    }
    // Create a new user

    public function store( Request $request ) {
        // Validate incoming request
        $validator = Validator::make( $request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 422 );
        }

        // Create the user
        $user = User::create( [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password ),
        ] );

        return response()->json( [ 'user' => $user, 'message' => 'User created successfully!' ], 201 );
    }
}