<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Validator;
use Response;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Get all transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();

        return response()->json([
            "success" => true,
            "total"=>count($transaction),
            "message" => "Transactions retrieved successfully.",
            "data" => $transaction
        ]);
    }

    /**
     * Create a new insurance.
     * Method: POST
     * 
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'amount' => 'required',
            'time' => 'required',
            'from_account' => 'required',
            'to_account' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
              'errors' => $validator->errors(),
              'status' => 'Validation failed',
            ]);
        }
        
        $transaction = Transaction::create($input);
        return response()->json([
            "success" => true,
            "message" => "Transaction added successfully.",
            "data" => $transaction
        ]);
    }

    /**
     * Update a insurance.
     * Method: PATCH
     * 
     */
    public function update($id,Request $request)
    {
        
        $transaction = Transaction::findOrFail($id);
        //print_r($transaction);
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'amount' => 'required',
            'time' => 'required',
            'from_account' => 'required',
            'to_account' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
              'errors' => $validator->errors(),
              'status' => 'Validation failed',
            ]);
        }

             
        Transaction::where('id',$id)->update($input);

        
        return response()->json([
            "success" => true,
            "message" => "Transaction updated successfully.",
                      
        ]);
    }

    /*
    * Delete a insyrance
    */

    public function delete($id){
        $transaction = Transaction::findOrFail($id);
        if($transaction) {
            $transaction->delete(); 
            return response()->json([
                "success" => true,
                "message" => "Transaction record delete successfully.",
               
            ]);
        } 
        
        else {
            return response()->json([
                "success" => false,
                "message" => "There is some error",
               
            ]);
        }
        
    }
}
