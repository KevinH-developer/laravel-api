<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class proyectController extends Controller
{
    public function index()
    {
        $proyects = Proyect::all();

        // if ($proyects->isEmpty()){
        //     $data = [
        //         'message' => 'No se encontraron proyectos',
        //         'status' => 200
        //     ];
        //     return response()->json($data, 404);
        // }

        $data = [
            'proyects' => $proyects,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'proyectName' => 'required',
            'description' => 'required',
            'objective' => 'required',
            'duration' => 'required',
            'category' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required'
        ]);


        if ($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $imagePath = $request->file('image_path')->store('images', 'public');

        $proyect = Proyect::create([
            'proyectName' => $request->proyectName,
            'description' => $request->description,
            'objective' => $request->objective,
            'duration' => $request->duration,
            'category' => $request->category,
            'image_path' => $imagePath,
            'username' => $request->username
        ]);
        
        if (!$proyect){
            $data = [
                'message' => 'Error al crear proyecto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'proyect' => $proyect,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $proyect = Proyect::find($id);

        if(!$proyect){
            $data = [
                'message' => 'Proyecto no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'proyect' => $proyect,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function destroy($id)
    {
        $proyect = Proyect::find($id);

        if(!$proyect){
            $data = [
                'message' => 'Proyecto no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $proyect->delete();

        $data = [
            'message' => 'Proyecto Eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function update(Request $request, $id)
    {
        $proyect = Proyect::find($id);

        if(!$proyect){
            $data = [
                'message' => 'Proyecto no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'proyectName' => 'required',
            'description' => 'required',
            'objective' => 'required',
            'duration' => 'required',
            'category' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required'
        ]);


        if ($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $imagePath = $request->file('image_path')->store('images', 'public');

        $proyect->proyectName = $request->proyectName;
        $proyect->description = $request->description;
        $proyect->objective = $request->objective;
        $proyect->duration = $request->duration;
        $proyect->category = $request->category;
        $proyect->image_path = $imagePath;
        $proyect->username = $request->username;

        $proyect->save();

        $data = [
            'message' => 'Proyecto Actualizado',
            'proyect' => $proyect,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function updatePartial(Request $request, $id)
    {
        $proyect = Proyect::find($id);

        if(!$proyect){
            $data = [
                'message' => 'Proyecto no encontrado',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(),[
            'proyectName' => '',
            'description' => '',
            'objective' => '',
            'duration' => '',
            'category' => '',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => ''
        ]);


        if ($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('proyectName')){
            $proyect->proyectName = $request->proyectName;
        }

        if ($request->has('description')){
            $proyect->description = $request->description;
        }

        if ($request->has('objective')){
            $proyect->objective = $request->objective;
        }

        if ($request->has('duration')){
            $proyect->duration = $request->duration;
        }

        if ($request->has('category')){
            $proyect->category = $request->category;
        }

        $imagePath = $request->file('image_path')->store('images', 'public');
        if ($request->has('image_path')){
            $proyect->image_path = $imagePath;
        }

        if ($request->has('username')){
            $proyect->username = $request->username;
        }
        
       
        $proyect->save();

        $data = [
            'message' => 'Proyecto Actualizado',
            'proyect' => $proyect,
            'status' => 200
        ];

        return response()->json($data, 200);

    }


}
