<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $items = Item::all();
        return response()->json( $items );
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

    public function store( Request $request ) {
        {
            $item = new Item( [
                'name' => $request->get( 'name' ),
                'price' => $request->get( 'price' )
            ] );

            $item->save();
            return response()->json( 'Successfully added' );
        }
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
        $item = Item::find( $id );
        return response()->json( $item );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $item = Item::find( $id );
        $item->name = $request->get( 'name' );
        $item->price = $request->get( 'price' );
        $item->save();

        return response()->json( 'Successfully Updated' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $item = Item::find( $id );
        $item->delete();

        return response()->json( 'Successfully Deleted' );
    }
}