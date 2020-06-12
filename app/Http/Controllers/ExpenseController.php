<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseController extends Controller
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
    public function index()
    {
        $expenses = Expense::all();
        return $this->successResponse($expenses);
    }

    /**
     * create one new  $expense
     *
     * @return  Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|min:1',
            'group_id' => 'required|min:1',
            'title' => 'required|max:255',
            'beneficiary' => 'required|max:255',
            'amountSpent' => 'required|min:1.00',
            'month'       => 'required|max:8',
        ];

        $this->validate($request, $rules);

        $expense = Expense::create($request->all());
        $expense = Expense::findorfail($expense['id']);
        $user = User::findorfail($expense['user_id']);
        $expense['percentage'] = ((($expense['amountSpent'] * 100) / ($user['budget'])));
        $user['totalAmountSpent'] += $expense['amountSpent'];
        $user['balance'] -= $expense['amountSpent'];
        var_dump($expense['amountSpent']);
        if(($expense['amountSpent'] > $user['balance'])){
            unset($expense);
            return $this->errorResponse('Amount spent cannot be greater than balance', Response::HTTP_FORBIDDEN);
        }
        else if (($user['balance'] >= 0) && ($user['totalAmountSpent'] <= $user['budget'])) {
            $user['totalPercentage'] = (100 - ($user['balance'] * 100 / ($user['budget'])));
            $user->save();
            $expense->save();
            return $this->successResponse($expense, Response::HTTP_CREATED);

        }
        return $this->errorResponse('expense percent cannot be greater than 100', Response::HTTP_FORBIDDEN);
    }

    /**
     * Obtain and show one expense
     *
     * @return  Illuminate\Http\Response
     */
    public function show($expense)
    {
        $expense = Expense::findOrFail($expense);
        return $this->successResponse($expense);

    }

    /**
     * Update an existing  $expense
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Request $request, $expense)
    {
        $rules = [
            'user_id' => 'min:1',
            'group_id' => 'min:1',
            'title' => 'max:255',
            'beneficiary' => 'max:255',
            'amountSpent' => 'min:1',
        ];

        $this->validate($request, $rules);
        $expense = Expense::findOrFail($expense);
        $expense->fill($request->all());

        if ($expense->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $expense->save();

        return $this->successResponse($expense);

    }

    /**
     * Remove an existing  $expense
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy($expense)
    {
        $expense = Expense::findOrFail($expense);

        $expense->delete();

        return $this->successResponse($expense);

    }
}
