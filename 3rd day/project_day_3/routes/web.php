<?php

use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    $companies = Company::all();
    return view('welcome', compact('companies'));
});
Route::get("/About", function (){
    return view("About");
});

Route::post("/save-company", function (Request $request) {
    $company = new Company();
    $company->name = $request->name;
    $company->company_name = $request->company_name;
    $company->role = $request->role;
    $company->phone = $request->phone;
    $company->email = $request->email;
    $file = $request->logo;
    if($file){
        $NewName = time().".".$file->getClientOriginalExtension();
        $file->move('images',$NewName);
        $company->logo = "images/$NewName";
    }
    $company->save();
    return redirect('/');
});