<?php

namespace App\Http\Controllers;
use App\Models\Group_User;
use Illuminate\Http\Request;

class Group_UserController extends Controller
{
   /**
     *@return mixed 
     */
    /**
     *To show all group_user ids page in database  
     */
    public function index()
    {
      $group_user = Group_User::all();
        return response()->json([
            'data' => $group_user,
            
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * to show one group_user from database by ID
     */
    public function show($id)
    {
        $group_user = Group_User::find($id);

        if (!$group_user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group_user with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $group_user
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException

     */
    /**
     *Create  group_user
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           
            'id_user' => 'required',
            'id_group' => 'required',

        ]);

        $group_user = new Group_User();
        $group_user->id_user= $request->id_user;
        $group_user->id_group= $request->id_group;
      
        if ($group_user->save())
            return response()->json([
                'success' => true,
                'data' => $group_user
                
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'group_user store function error'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
   
     */
    /**
     * Update one group_user
     */

    public function update(Request $request, $id)
    {
        $group_user = Group_User::find($id);

        if (!$group_user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group_user id:' . $id . 'cannot be found'
            ], 400);
        }

    
        $updated = $group_user->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $group_user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group_user is not updated'
            ], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * to delete one group_user
     */
    public function destroy($id)
    {
        $group_user = Group_User::find($id);

        if (!$group_user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group_user id:' . $id . ' can not be found.'
            ], 400);
        }

        if ($group_user->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'you can not delete group_user'
            ], 500);
        }
    }

}
