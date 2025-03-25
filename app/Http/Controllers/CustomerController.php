<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $customers = Customer::with('assignedEmployee')->get();
        } else {
            $customers = Customer::where('assigned_to', Auth::id())
                ->orWhere('created_by', Auth::id())
                ->get();
        }
        
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view('customers.create', compact('employees'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $validated = $request->validated();

        $customer = new Customer($validated);
        $customer->created_by = Auth::id();
        
        // If user is not admin and tries to assign to someone else, assign to self
        if (!Auth::user()->isAdmin() && $request->assigned_to != Auth::id()) {
            $customer->assigned_to = Auth::id();
        }
        
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer created successfully');
    }

    public function show(Customer $customer)
    {
        $this->authorize('view', $customer);
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);
        $employees = User::where('role', 'employee')->get();
        return view('customers.edit', compact('customer', 'employees'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);
        
        $validated = $request->validated();

        // If user is not admin and tries to assign to someone else, keep current assignment
        if (!Auth::user()->isAdmin() && $request->assigned_to != $customer->assigned_to) {
            $validated['assigned_to'] = $customer->assigned_to;
        }
        
        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }

    public function assign(Request $request, Customer $customer)
    {
        $this->authorize('assign', $customer);
        
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);
        
        $customer->update([
            'assigned_to' => $validated['assigned_to']
        ]);
        
        return redirect()->route('customers.show', $customer)->with('success', 'Customer assigned successfully');
    }
}
