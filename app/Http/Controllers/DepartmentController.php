<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //index
    public function index()
    {
        return response()->json(Department::all());
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:departments,name']);
        Department::create($request->all());
        return response()->json("Department Registed", 200);
    }
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|unique:departments,name,' . $id]);
        Department::findorfail($id)->update($request->all());
        return response()->json("Department Updated", 200);
    }
    public function destroy($id)
    {
        Department::findorfail($id)->delete();
        return response()->json("Department Deleted", 200);
    }
}
