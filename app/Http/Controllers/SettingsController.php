<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //index
    public function index()
    {
        $departments = Department::orderByDesc('id')->get();
        return view('settings', compact('departments'));
    }
    public function storeDepartment(Request $request)
    {
        $request->validate(['name' => 'required|unique:departments,name']);
        try {
            Department::create($request->all());
            return back()->with('success', 'Department Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    public function updateDepartment(Request $request, $id)
    {
        $request->validate(['name' => 'required|unique:departments,name,' . $id]);
        try {
            Department::findorfail($id)->update($request->all());
            return back()->with('success', 'Department Updated Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroyDepartment($id)
    {
        try {
            Department::findorfail($id)->delete();
            return back()->with('success', 'Department Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
