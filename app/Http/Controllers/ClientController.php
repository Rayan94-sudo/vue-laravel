<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     *@return mixed 
     */
    /**
     *To show all Users page in database  
     */
    public function index()
    {
      $user = User::all();
        return response()->json([
            'data' => $user,
            
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * to show one user from database by ID
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException

     */
    /**
     *Create  user
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           
            'name' => 'required',
            'email' =>'required',
            'password' => 'required',
            'active' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'active'  => $request->active,
            'role'=> $request->role
        ]);

        if ($user->save())
            return response()->json([
                'success' => true,
                'data' => $user
                
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'user store function error'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
   
     */
    /**
     * Update one user 
     */

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user id:' . $id . 'cannot be found'
            ], 400);
        }

    
        $updated = $user->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user is not updated'
            ], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * to delete one user
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user id:' . $id . ' can not be found.'
            ], 400);
        }

        if ($user->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'you can not delete user'
            ], 500);
        }
    }
}
