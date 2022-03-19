<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeCreateController extends Controller
{
    public function create()
    {
        $users = User::employees()->get();
        $positions = Position::all();
        return view('employees.create', compact('users', 'positions'));
    }

    public function getHead(Request $request)
    {
        $query = '';
        if ($request->has('head')) {
            $query = $request->head;
        }
        if ($request->has('position_id')) {
            $positionId = $request->position_id;
        }else{
            $positionId = Position::getPositionIdByName('Backend developer');
        }
        if($query != '' &&  is_numeric($positionId)){
            $employees = User::employees()
                ->where('name', 'like', '%' .$query . '%')
                ->where('position_id', '>=', $positionId)
                ->orderby('name','asc')
                ->select('id','name')
                ->limit(5)
                ->get();
        }else{
            $employees = User::employees()
                ->orderby('name','asc')
                ->select('id','name')
                ->limit(5)
                ->get();
        }
        $response = array();
        foreach($employees as $employee){
            $response[] = array("value"=>$employee->id,"label"=>$employee->name);
        }

        return response()->json($response);
    }
}
