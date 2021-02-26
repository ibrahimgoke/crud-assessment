<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the record.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the books
        $books = Book::all();
            return response()->json([
                'success' => "success",
                'data' => $books
            ], 200);
    }

    /**
     * Store a newly created record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'isbn' => 'required',
                'authors' => 'required',
                'country' => 'required|string|max:255',
                'number_of_pages' => 'required',
                'publisher' => 'required|string|max:255',
                'release_date' => 'required|date|max:255',
            ]);
            if ($validator->fails()) {
                return response(['errors'=>$validator->errors()->all()], 422);
            }
            $book = Book::create([
                'name' => $request->name,
                'isbn' => $request->isbn,
                'authors' => [$request->authors],
                'country' => $request->country,
                'number_of_pages' => $request->number_of_pages,
                'publisher' => $request->publisher,
                'release_date' => $request->release_date,
            ]);
            if($book) {
                return response()->json([
                    'status' => true,
                    'data' => [[
                        'book' => [
                            'name' => $request->name,
                            'isbn' => $request->isbn,
                            'authors' => [$request->authors],
                            'country' => $request->country,
                            'number_of_pages' => $request->number_of_pages,
                            'publisher' => $request->publisher,
                            'release_date' => $request->release_date,
                    ]]]
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Book can not be created.',
                ]);
            }
        }
    }

    /**
     * Display the specified record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findorfail($id);
        return response()->json([
            'success' => "success",
            'data' => [
            'name' => $book->name,
            'isbn' => $book->isbn,
            'authors' => [$book->authors],
            'country' => $book->country,
            'number_of_pages' => $book->number_of_pages,
            'publisher' => $book->publisher,
            'release_date' => $book->release_date,
            ]
        ], 200);
    }

    /**
     * Update the specified record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findorfail($id);
        $updated = $book->fill($request->all())->save();
        if ($updated)
            return response()->json([
                'success' => "success",
                'message' => 'The book ' .$request->name .' was updated successfully',
                'data' => [
                'name' => $request->name,
                'isbn' => $request->isbn,
                'authors' => [$request->authors],
                'country' => $request->country,
                'number_of_pages' => $request->number_of_pages,
                'publisher' => $request->publisher,
                'release_date' => $request->release_date,
                ]
            ], 200);
    }

    /**
     * Remove the specified record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findorfail($id);
        $book->delete();

        return response()->json([
            'success' => "success",
            'message' => 'The book ' .$book->name .' was updated successfully',
            'data' => []
        ], 204);
    }
}
