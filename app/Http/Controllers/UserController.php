<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
     */
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

        // Return the user data as JSON for AJAX
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
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
}