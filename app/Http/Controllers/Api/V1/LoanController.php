<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use Validator;
use Response;

class LoanController extends Controller
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
     * Get all loans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loan = Loan::all();

        return response()->json([
            "success" => true,
            "total"=>count($loan),
            "message" => "Loans retrieved successfully.",
            "data" => $loan,
            
        ]);
    }

    /**
     * Create a new loan.
     * Method: POST
     * 
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'amount' => 'required',
            'type' => 'required',
            'agent_name' => 'required',
            'rate_of_interest' => 'required',
            'duration' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
              'errors' => $validator->errors(),
              'status' => 'Validation failed',
            ]);
        }
        
        $loan = Loan::create($input);
        return response()->json([
            "success" => true,
            "message" => "Loan added successfully.",
            "data" => $loan
        ]);
    }

    /**
     * Update a loan.
     * Method: PATCH
     * 
     */
    public function update($id,Request $request)
    {
        
        $loan = Loan::findOrFail($id);
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'amount' => 'required',
            'type' => 'required',
            'agent_name' => 'required',
            'rate_of_interest' => 'required',
            'duration' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
              'errors' => $validator->errors(),
              'status' => 'Validation failed',
            ]);
        }

             
        Loan::where('id',$id)->update($input);

        
        return response()->json([
            "success" => true,
            "message" => "Loan updated successfully.",
           
        ]);
    }

    /*
    * Delete a loan
    */

    public function delete($id){
        $loan = Loan::findOrFail($id);
        if($loan) {
            $loan->delete(); 
            return response()->json([
                "success" => true,
                "message" => "Loan record delete successfully.",
               
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
