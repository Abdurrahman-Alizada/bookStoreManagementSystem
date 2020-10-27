<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Books::latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  $this->validate($request , [
        //      'title'        => 'required | string | max:191',
        //      'author'       => 'required | string | max:191' ,
        //      'totalPages'   => 'required | integer',
        //      'price'        => 'required | integer',
        //      'ISBN'         => 'required | string',
        //      'category'     => 'required | string',
        //      'publish_date' => 'required | date',
        //      'publisher_id' => 'required | string',

        //      ]);

        return Books::create([
            'title'       =>  $request['title'],
            'author'      =>  $request['author'],
            'totalPages'  =>  $request['totalPages'],
            'price'       =>  $request['price'],
            'ISBN'        =>  $request['ISBN'],
            'category'    =>  $request['category'],
            'publish_date'=>  $request['publish_date'],
            'publisher_id'=>  $request['publisher_id'],
             ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Book = Books::findOrFail($id);

        // $this->validate($request,[
        //     'title'        => 'required | string | max:191',
        //      'author'       => 'required | string | max:191' ,
        //      'totalPages'   => 'required | integer',
        //      'price'        => 'required | integer',
        //      'ISBN'         => 'required | string',
        //      'category'     => 'required | string',
        //      'publish_date' => 'required | date',
        //      'publisher_id' => 'required | string',
        //      ]);

        $Book->update($request->all());
        return ['message' => 'Updated the Book info'];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Book = Books::findOrFail($id);

        $Book->delete();

        return ['message' => 'Book Deleted'];

    }
}
