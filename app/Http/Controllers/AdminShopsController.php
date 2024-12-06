<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Course;
use App\Models\GCashInfo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminShopsController extends Controller
{
    public function index()
    {
        // Fetch all shops with related data, including business managers and their users
        $shops = Shop::with(['user', 'course', 'status', 'businessManagers.user'])->get();
    
        return view('livewire.admin.admin-shops', compact('shops'));
    }
    

    public function show($id)
    {
       // Retrieve the user along with course and status using eager loading
        $shop = Shop::with(['g_cash_info', 'course', 'status'])->findOrFail($id);

    // Return the data as JSON
        return response()->json([
            'shop' => $shop,

        ]);
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        // Update the user's profile
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function create(Request $request, Shop $shop)
    {
        //
    }

    public function search(Request $request)
{
    $query = Shop::with(['user:id,first_name,last_name', 'course', 'status']); // Eager load only the user relationship

    // Apply search filter if the search query is provided (for shop names only)
    if ($request->has('search') && !empty($request->search)) {
        $query->where('shop_name', 'like', '%' . $request->search . '%');
    }

    
    // Apply course filter if the course parameter is provided
    if ($request->has('courseCall') && !empty($request->courseCall)) {
        $query->whereHas('course', function($q) use ($request) {
            $q->where('id', $request->courseCall);
        });
    }

    // Return the filtered results (using pagination for example)
    return $query->get(); // or use get() if you don't need pagination
}


    public function runResults(Request $request)
    {
        // Get users from the search method
        $shops = $this->search($request);

        // Return the filtered users as JSON
        return response()->json($shops);
    }

    public function edit($id)
    {
        // Fetch the shop with the given id
        $shop = Shop::findOrFail($id);
        
        // You may also need other data for the form, like the courses for the dropdown
        $courses = Course::all(); // Example, adjust based on your data structure
        
        // Return the view with the shop data and any other necessary data
        return view('admin.shops.edit', compact('shop', 'courses'));
    }

    public function statusChange(Request $request, $shopId)
    {
        try {
            \Log::info('Updating status for User ID:', ['user_id' => $shopId]);
            \Log::info('Request Data:', $request->all());
    
            $shop = Shop::with(['status'])->findOrFail($shopId);
    
            // Validate the role_id
            $checking = $request->validate([
                'statusId' => 'required|exists:statuses,id',
            ]);
    
            // Update the user's role
            $shop->status_id = $checking['statusId'];
            $shop->updated_at = Carbon::now();
            $shop->save();
    
            \Log::info('Status updated successfully for User ID:', ['shop_id' => $shopId]);
    
            return response()->json(['message' => 'User status updated successfully.']);
        } 
        catch (\Exception $e) {
            \Log::error('Error updating status:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to update status thru controller. ' . $e->getMessage()], 500);
        }
    }

}
