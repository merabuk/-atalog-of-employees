<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ImageModel;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::employees()->with(['position', 'image'])->get();
        return view('employees.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::employees()->get();
        $positions = Position::all();
        return view('employees.create', compact('users', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['password'] = Hash::make('password');
        $validatedRequest['admin_created_id'] = auth()->user()->id;
        $validatedRequest['admin_updated_id'] = auth()->user()->id;
        $employeeRoleId = Role::getRoleBySlug('employee')->id;
        $validatedRequest['role_id'] = $employeeRoleId;

        $user = User::create($validatedRequest);

        $imageName = Str::random(40);
        $image['path'] = 'images/'.$imageName.'.jpg';
        $fullPath = public_path('storage/'.$image['path']);
        $image['user_id'] = $user->id;
        Image::make($validatedRequest['image'])->fit(300)->save($fullPath, 80);
        $user = ImageModel::create($image);

        return redirect()->route('employees.index')->with('alert-success', 'Employee has been successfuly created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee)
    {
        $positions = Position::get();
        return view('employees.edit', compact('employee', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, User $employee)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['admin_created_id'] = auth()->user()->id;
        $validatedRequest['admin_updated_id'] = auth()->user()->id;
        $employee->update($validatedRequest);
        if (isset($validatedRequest['image'])) {
            $oldPath = $employee->image->path;
            $imageName = Str::random(40);
            $imagePath = 'images/'.$imageName.'.jpg';
            $fullPath = public_path('storage/'.$imagePath);
            Image::make($validatedRequest['image'])->fit(300)->save($fullPath, 80);
            $employee->image->path = $imagePath;
            $employee->push();
            Storage::disk('public')->delete($oldPath);
        }

        return redirect()->route('employees.index')->with('alert-success', 'Employee has been successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $employee)
    {
        $oldPath = $employee->image->path;
        $employee->image()->delete();
        $employee->delete();
        Storage::disk('public')->delete($oldPath);
        $request->session()->put('alert-info', 'Employee has been deleted');
        if ($request->ajax()) {
            return response('deleted');
        }
        return redirect()->back();
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
