<?php
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index','store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        $limit = ($limit > 50) ? 50 : $limit;
        $user  = UserResource::collection(User::paginate($limit));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->authorize('create', User::class);
        $user = new UserResource(User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]));
        return $user->response()->setStatusCode(200);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = new UserResource(User::findOrFail($id));
        return $user->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', User::class);

        $idUser = User::findOrFail($id);
        $this->authorize('update', $idUser);
        $user = new UserResource(User::findOrFail($id));
        $user->update($request->all());
        return $user->response()->setStatusCode(200, "User Updated Succeffully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userid = User::findOrFail($id);
        $this->authorize('delete', $userid);
        User::findOrFail($id)->delete();
        return 204;
    }
}
