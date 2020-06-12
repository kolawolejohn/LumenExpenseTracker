<?php

namespace App\Http\Controllers;
use App\ExpenseGroup;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseGroupController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // list all the expense group available
    public function index(){
        $expenseGroups = ExpenseGroup::all();
        return $this->successResponse($expenseGroups);
    }

    /**
     * create one new  $expenseGroup
     *
     * @return  Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules = [
            'category' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $expenseGroup = ExpenseGroup::create($request->all());
        return $this->successResponse($expenseGroup, Response::HTTP_CREATED);
    }

    /**
     * Obtain and show one expense group
     *
     * @return  Illuminate\Http\Response
     */
    public function show($expenseGroup){
        $expenseGroup = ExpenseGroup::findOrFail($expenseGroup);
        return $this->successResponse($expenseGroup);

    }

    /**
     * Update an existing  $expenseGroup
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Request $request, $expenseGroup){
        $rules = [
            'category' => 'max:255',
        ];

        $this->validate($request, $rules);
        $expenseGroup = ExpenseGroup::findOrFail($expenseGroup);
        $expenseGroup->fill($request->all());

        if($expenseGroup->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $expenseGroup->save();

        return $this->successResponse($expenseGroup);

    }

    /**
     * Remove an existing  $expenseGroup
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy($expenseGroup){
        $expenseGroup = ExpenseGroup::findOrFail($expenseGroup);

        $expenseGroup->delete();

        return $this->successResponse($expenseGroup);

    }
}