<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all the user rows from the database
        $users = User::with(['status', 'course', 'role'])->get();
        return view('livewire.admin.admin-users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \App\Models\User  $user
     */

     public function edit($userId)
     {
        $user = User::with('role', 'course', 'status')->find($userId);
        $roles = Role::all(); // Fetch all roles
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['user' => $user, 'roles' => $roles]);
     }
 
     // Update user role

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // Retrieve the user along with course and status using eager loading
        $user = User::with(['role', 'course', 'status'])->findOrFail($id);
        $roles = Role::all();
        dd($roles); 
 
        return response()->json([
            'route_name' => request()->route()->getName(),
            'route_uri' => request()->route()->uri(),
            'parameters' => request()->route()->parameters(),
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    
     public function update(Request $request, $id)
{
    // Validate the role ID
    $request->validate([
        'role_id' => 'required|exists:roles,id',
    ]);

    // Fetch the user and update their role
    $user = User::findOrFail($id);
    $user->role_id = $request->role_id;
    $user->save();

    // Redirect back with a success message
    return redirect()->route('users.edit', $id)->with('success', 'Role updated successfully.');
}
public function updateRole(Request $request, $userId)
{
    try {
        \Log::info('Updating role for User ID:', ['user_id' => $userId]);
        \Log::info('Request Data:', $request->all());

        $user = User::with(['role', 'course', 'status'])->findOrFail($userId);

        // Validate the role_id
        $checking = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Update the user's role
        $user->role_id = $checking['role_id'];
        $user->modified_at = Carbon::now();
        $user->save();

        \Log::info('Role updated successfully for User ID:', ['user_id' => $userId]);

        return response()->json(['message' => 'User role updated successfully.']);
    } 
    catch (\Exception $e) {
        \Log::error('Error updating role:', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Failed to update role thru controller. ' . $e->getMessage()], 500);
    }
}

    public function search(Request $request)
    {
        $query = User::with(['course', 'status', 'role']); // Eager load relationships

        // Apply search filter if the search query is provided (for names and role)
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('role', function ($forRole) use ($request) {
                      $forRole->where('role_name', 'like', '%' . $request->search . '%');
                  });
            });
        }
    
        // Apply course filter if the course parameter is provided
        if ($request->has('courseCall') && !empty($request->course)) {
            $query->whereHas('course', function($q) use ($request) {
                $q->where('course_name', $request->course);
            });
        }

        // Return the filtered users
        return $query->get();
    }

    public function runResults(Request $request)
    {
        // Get users from the search method
        $users = $this->search($request);

        // Return the filtered users as JSON
        return response()->json($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function statusChange(Request $request, $userId)
    {
        try {
            \Log::info('Updating status for User ID:', ['user_id' => $userId]);
            \Log::info('Request Data:', $request->all());
    
            $user = User::with(['role', 'course', 'status'])->findOrFail($userId);
    
            // Validate the role_id
            $checking = $request->validate([
                'statusId' => 'required|exists:statuses,id',
            ]);
    
            // Update the user's role
            $user->status_id = $checking['statusId'];
            $user->modified_at = Carbon::now();
            $user->save();
    
            \Log::info('Status updated successfully for User ID:', ['user_id' => $userId]);
    
            return response()->json(['message' => 'User status updated successfully.']);
        } 
        catch (\Exception $e) {
            \Log::error('Error updating status:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to update status thru controller. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get the mapping of checkbox IDs to permission IDs.
     *
     * @return array
     */
    protected function getPermissionMap()
    {
        return [
            'addProducts' => 1,
            'editProducts' => 2,
            'deleteProducts' => 3,
            'generateReports' => 4,
            'markProduct' => 5,
            'lowStocksAlert' => 6,
            'accessChatbox' => 7,
            'studentQueries' => 8,
        ];
    }

    public function editPermissions(User $user)
{
    $permissionMap = $this->getPermissionMap();
    $userPermissions = $user->permissions->pluck('id')->toArray();

    return view('edit-permissions', compact('user', 'permissionMap', 'userPermissions'));
}

public function updatePermissions(Request $request, User $user)
{
    $validated = $request->validate([
        'permissions' => 'array',
        'permissions.*' => 'string',
    ]);

    // Get permission map
    $permissionMap = $this->getPermissionMap();

    // Map checkbox IDs to permission IDs
    $permissionIds = array_map(fn($value) => $permissionMap[$value], $validated['permissions']);

    // Sync the permissions for the user
    $user->permissions()->sync($permissionIds);

    return back()->with('success', 'Permissions updated successfully!');
}

    
}