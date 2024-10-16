<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order_list;
use Illuminate\Support\Facades\DB;


class OrderBackendController extends Controller
{
    public function AllOrders()
    {
        return view('backend.orders.all_orders');
    }

    public function filterOrders(Request $request)
    {
        // Get the selected date from the request
        $selectedDate = $request->input('search_date');
    
        // Query the database to fetch orders for the selected date
        $all_orders = DB::table('aft_registration')
            ->where('dol', $selectedDate)
            ->select(
                'id as registration_id', // Select the id of aft_registration
                'registration_no', // You can add any other necessary columns
                'dol'
            )
            ->get();
    
        // Fetch all the existing orders from order_lists where registration_no + dol exists
        $existing_orders = DB::table('order__lists')
            ->select('registration_no', 'date_of_order')
            ->get()
            ->keyBy(function ($item) {
                return $item->registration_no . '-' . $item->date_of_order;
            });
    
        // Return the results and the existing orders to the view
        return view('backend.orders.all_orders', compact('all_orders', 'existing_orders'));
    }
    

    public function AddOrder($id, $dol)
    {
    
        // Query the database to get the registration data and related dol_dependency data for the specific date
        $registration = DB::table('aft_registration')
            ->where('id', $id) // Filter by registration ID
            ->where('dol', $dol) // Filter by the specific Date of Order (dol)
            ->select('aft_registration.*') // Select the necessary fields from both tables
            ->first();  // Use first() to get a single matching record
    
        // Check if registration and dependency data are found
        if (!$registration) {
            // Optionally handle the case where no data is found
            return redirect()->back()->with('error', 'No registration found with the given ID and date.');
        }
    
        // Pass the registration and dependency data to the view
        return view('backend.orders.add_order', compact('registration', 'dol'));
    }

    public function storeOrder(Request $request)
    {
        // Validation
        $request->validate([
            'registration_no' => 'required|string|max:191',
            'date_of_order' => 'required|string',
            'applicants' => 'required|string|max:191',
            'padvocate' => 'required|string|max:191',
            'radvocate' => 'required|string|max:191',
            'respondent' => 'required|string|max:191',
            'court_no' => 'required|integer',
            'sno_cause_list' => 'required|string|max:191',
            'content' => 'nullable|string',  // Add content for editing
        ]);
    
        // Check if the order exists (for editing)
        $order = Order_list::where('registration_no', $request->registration_no)
            ->where('date_of_order', $request->date_of_order)
            ->first();
    
        if ($order) {
            // Update the existing order
            $order->update([
                'applicants' => $request->applicants,
                'padvocate' => $request->padvocate,
                'radvocate' => $request->radvocate,
                'respondent' => $request->respondent,
                'court_no' => $request->court_no,
                'sno_cause_list' => $request->sno_cause_list,
                'content' => $request->content, // Save content when editing
            ]);
    
            // Return with a success message for update
            return redirect()->back()->with('success', 'Order updated successfully!');
        } else {
            // Create a new OrderList instance and store data in the database
            Order_list::create([
                'registration_no' => $request->registration_no,
                'date_of_order' => $request->date_of_order,
                'applicants' => $request->applicants,
                'padvocate' => $request->padvocate,
                'radvocate' => $request->radvocate,
                'respondent' => $request->respondent,
                'court_no' => $request->court_no,
                'sno_cause_list' => $request->sno_cause_list,
                'content' => $request->content, // Save content for new entry
            ]);
    
            // Redirect back with a success message for creation
            return redirect()->back()->with('success', 'Order added successfully!');
        }
    }
    

    public function EditOrder($regno, $dol)
{
    // Modify the input to remove non-alphanumeric characters
    $regno = preg_replace('/[^A-Za-z0-9]/', '', $regno);

    // Modify the query to strip characters in the registration_no field
    $order = DB::table('order__lists')
        ->where(DB::raw("REPLACE(REPLACE(registration_no, ' ', ''), '/', '')"), $regno)
        ->where('date_of_order', $dol)
        ->first();

    return view('backend.orders.edit_order', compact('order'));
}

    

    


}
