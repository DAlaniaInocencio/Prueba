<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsControllers extends Controller
{
    
    // Método para obtener todos los posts
     public function getAll(Request $request)
     {

         return Post::with('user')->get(); // Incluye el usuario que creó el post
     }
 
     public function create(Request $request){
        try {
            // Validación de los campos requeridos
            $request->validate([
                'title' => 'required|string|max:255|unique:posts',
                'description' => 'required|string',
                'user_id' => 'required|exists:users,id', // Asegúrate de que el ID del usuario exista
            ]);
    
            // Crear el nuevo post
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
            ];
    
            // Crea un nuevo post
            $post = Post::create($data);
            
            // Retorna la respuesta
            return response()->json($post, 201);
        } catch (\Throwable $th) {
            // Manejo de errores
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function getid($id){
        try {
            $data = Post::find($id);
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(["error"->$th->getMessage()],500);
        }
    }

    public function update(Request $request, $id){
       
        try {
            
            // Buscar el post por su ID
            $post = Post::findOrFail($id);  

            // Validar solo los campos que se envían en la solicitud
            $validatedData = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string|max:255',
            ]);
    
            // Buscar el post por su ID
            $post = Post::findOrFail($id);
    
            // Actualizar los datos del post solo si están presentes en la solicitud
            if ($request->has('title')) {
                $post->title = $validatedData['title'];
            }
    
            if ($request->has('description')) {
                $post->description = $validatedData['description'];
            }
    
            // Guardar los cambios
            $post->save();
    
            // Retornar la respuesta en formato JSON
            return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
        } catch (\Exception $e) {
            // Capturar y devolver cualquier error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id){
        try {
            $data = Post::find($id)->delete();
            return response()->json(["deleted"=>$data],200);
        } catch (\Throwable $th) {
            return response()->json(["error"->$th->getMessage()],500);
        }
    }
}
