<?php

namespace App\Http\Controllers;
use App\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $budget;
    public $balance;

    public function __construct()
    {
        //
    }

    // list all the expense group available
    public function index(){
        $users = user::all();
        return $this->successResponse($users);
    }

    /**
     * create one new  $user
     *
     * @return  Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = [
            'name' => 'required|max:255',
            'income' => 'required|min:1.00',
            'savings'  => 'required|min:1.00',
        ];

        $this->validate($request, $rules);

        $user = user::create($request->all());
        $user = user::findorfail($user['id']);
        $user['budget'] = $user['income'] - $user['savings'];
        $user['balance'] = $user['budget'];
        $this->budget = $user['budget'];
        $this->balance = $user['balance'];
        $user ->save();
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Obtain and show one user 
     *
     * @return  Illuminate\Http\Response
     */
    public function show($user){
        $user = user::findOrFail($user);
        return $this->successResponse($user);

    }

    /**
     * Update an existing  $user
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Request $request, $user){
        $rules = [
            'name' => 'max:255',
            'income' => 'min:1.00',
            'savings'  => 'min:1.00',
        ];

        $this->validate($request, $rules);
        $user = user::findOrFail($user);
        $user->fill($request->all());

        if($user->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->successResponse($user);

    }

    /**
     * Remove an existing  $user
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy($user){
        $user = user::findOrFail($user);

        $user->delete();

        return $this->successResponse($user);

    }
}