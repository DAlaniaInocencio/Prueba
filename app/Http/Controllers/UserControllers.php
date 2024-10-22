<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserControllers extends Controller
{
    //
       //
       public function getall(){
        try {
            $data = User::get();
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(["error"->$th->getMessage()],500);
        }
    }

    public function getid($id){
        try {
            $data = User::find($id);
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(["error"->$th->getMessage()],500);
        }
    }

    public function update(Request $request, $id){
        try {
            // Validar solo los campos que se envían en la solicitud
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,'.$id,
                'password' => 'nullable|string|min:8',
            ]);
    
            // Buscar el usuario por su ID
            $user = User::findOrFail($id);
    
            // Actualizar los datos del usuario solo si están presentes en la solicitud
            if ($request->has('name')) {
                $user->name = $validatedData['name'];
            }
    
            if ($request->has('email')) {
                $user->email = $validatedData['email'];
            }
    
            if ($request->has('password')) {
                $user->password = bcrypt($validatedData['password']);
            }
    
            // Guardar los cambios
            $user->save();
    
            // Retornar la respuesta en formato JSON
            return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
        } catch (\Exception $e) {
            // Capturar y devolver cualquier error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete($id){
        try {
            $data = User::find($id)->delete();
            return response()->json(["deleted"=>$data],200);
        } catch (\Throwable $th) {
            return response()->json(["error"->$th->getMessage()],500);
        }
    }
}
