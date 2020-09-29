<?php

namespace App\Http\Controllers;
use App\Models\Groups;
use Illuminate\Http\Request;

class GroupController extends Controller
{
     /**
     *@return mixed 
     */
    /**
     *To show all groups page in database  
     */
    public function index()
    {
      $groups = Groups::all();
        return response()->json([
            'data' => $groups,
            
        ]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * to show one group from database by ID
     */
    public function show($id)
    {
        $groups = Groups::find($id);

        if (!$groups) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group with id ' . $id . ' cannot be found.'
            ], 400);
        }


        return response()->json([
            'success' => true,
            'data' => $groups
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException

     */
    /**
     *Create  group
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $groups = new Groups();
        $groups->name= $request->name;
       
        if ($groups->save())
            return response()->json([
                'success' => true,
                'data' => $groups
                
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'group store function error'
            ], 500);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
   
     */
    /**
     * Update one group 
     */

    public function update(Request $request, $id)
    {
        $groups = Groups::find($id);

        if (!$groups) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group id:' . $id . 'cannot be found'
            ], 400);
        }

    
        $updated = $groups->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $groups
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group is not updated'
            ], 500);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * to delete one group
     */
    public function destroy($id)
    {
        $groups = Groups::find($id);

        if (!$groups) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, group id:' . $id . ' can not be found.'
            ], 400);
        }

        if ($groups->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'you can not delete group'
            ], 500);
        }
    }

}
