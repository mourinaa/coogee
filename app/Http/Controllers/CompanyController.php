<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
/**
  * 👉 Create Company
  *
  * @param  [string] name
  * @return [string] message
  */
  public function create(Request $request) {
    $request->validate([
        'name' => 'required|string'
    ]);

    $company = new Company([
        'name' => $request->name,
        'descriptions' => $request->descriptions,
        'address' => $request->address,
        'email' => $request->email,
        'phone' => $request->phone,
        'web' => $request->web,
        'logo' => $request->logo,
    ]);


    try {
        if ($company->save()){
            return response()->json([
                'message' => 'Company Has Been Created Successfully',
                'data' => $company
            ], 201);
        }
        return response()->json([
            'error' => 'Failure When Creating Company'
        ], 403);
    } catch (error) {
        return response()->json([
            'error' => 'Error When Creating Company'
        ], 409);
    }

  }


 /**
  * 👉 Update Company
  *
  * @param  [id] id company
  * @return [string] message
  */
  public function update(Request $request) {

    $request->validate([
        'id' => 'required'
    ]);

    $companyId = $request->id;
    $companyAt = Company::find($companyId);

    if (!$companyAt) {
        return response()->json([
            'error'=> 'Company Not Found'
        ], 405);
    }

    if ($companyAt->update($request->all())) {
        return response()->json([
            'data' => $companyAt
        ], 202);
    }

    return response()->json([
        'error'=> 'Failure Update Company'
    ], 403);

  }


  /**
   * 👉 Delete Company
   *
   * @param  [id]
   * @return [string] message
   */
   public function delete(Request $request) {
    $request->validate([
        'id' => 'required'
    ]);
    
    $companyId = $request->id;
    $companyAt = Company::find($id);
    if (!$companyAt) {
        return response()->json([
            'error'=> 'Company Not Found'
        ], 405);
    }
    if ($companyAt->delete($id)) {
        return response()->json([
            'message' => 'Company Successfully Deleted',
            'data' => $companyAt
        ], 202);
    }
    
    return response()->json([
        'error'=> 'COMPANY DELETE FAILURE'
    ]);
}



}
