<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class movieController extends Controller
{
    public function index()
    {
        $movie = Movie::all();
        
        $data=[
            'movie' => $movie,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'director' => 'required',
            'image' => 'required',
            'date' => 'required|date|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en validación',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $movie = Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'image' => $request->image,
            'date' => $request->date
        ]);

        if (!$movie) {
            $data = [
                'message' => 'Error al crear la película',
                'status' => 500
        
            ];

            return response()->json($data, 500);
        }

        $data = [
            'movie' => $movie,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show ($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            $data = [
                'message' => 'Pelicula no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'movie' => $movie,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy ($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            $data = [
                'message' => 'Pelicula no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $movie->delete();

        $data = [
            'message' => 'Pelicula eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update (Request $request, $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            $data = [
                'message' => 'Pelicula no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'director' => 'required',
            'image' => 'required',
            'date' => 'required|date|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en validación',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $movie->title = $request->title;
        $movie->director = $request->director;
        $movie->image = $request->image;
        $movie->date = $request->date;

        $movie->save();

        $data = [
            'message' => 'Pelicula actualizada',
            'movie' => $movie,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial (Request $request, $id)
    {
        $movie = Movie::find($id);
        
        if (!$movie) {
            $data = [
                'message' => 'Pelicula no encontrada',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'title',
            'director',
            'image',
            'date' =>'date|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en validación',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('title')) {
            $movie->title = $request->title;
        }

        if ($request->has('director')) {
            $movie->director = $request->director;
        }

        if ($request->has('image')) {
            $movie->image = $request->image;
        }

        if ($request->has('date')) {
            $movie->date = $request->date;
        }
        
        $movie->save();

        $data = [
            'message' => 'Pelicula actualizada',
            'movie' => $movie,
            'status' => 200
        ];

        return response()->json($data, 200);

}
}