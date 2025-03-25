<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Customer;
use App\Http\Requests\StoreActionRequest;
use App\Http\Requests\UpdateActionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Customer $customer)
    {
        $this->authorize('view', $customer);
        $actions = $customer->actions()->orderBy('action_date', 'desc')->get();
        return view('actions.index', compact('customer', 'actions'));
    }

    public function create(Customer $customer)
    {
        $this->authorize('createAction', $customer);
        return view('actions.create', compact('customer'));
    }

    public function store(StoreActionRequest $request, Customer $customer)
    {
        $this->authorize('createAction', $customer);
        
        $validated = $request->validated();

        $action = new Action($validated);
        $action->customer_id = $customer->id;
        $action->user_id = Auth::id();
        $action->save();

        return redirect()->route('customers.actions.index', $customer)->with('success', 'Action created successfully');
    }

    public function show(Customer $customer, Action $action)
    {
        $this->authorize('view', $action);
        return view('actions.show', compact('customer', 'action'));
    }

    public function edit(Customer $customer, Action $action)
    {
        $this->authorize('update', $action);
        return view('actions.edit', compact('customer', 'action'));
    }

    public function update(UpdateActionRequest $request, Customer $customer, Action $action)
    {
        $this->authorize('update', $action);
        
        $validated = $request->validated();
        
        $action->update($validated);

        return redirect()->route('customers.actions.index', $customer)->with('success', 'Action updated successfully');
    }

    public function destroy(Customer $customer, Action $action)
    {
        $this->authorize('delete', $action);
        $action->delete();
        return redirect()->route('customers.actions.index', $customer)->with('success', 'Action deleted successfully');
    }

    public function addResult(Request $request, Customer $customer, Action $action)
    {
        $this->authorize('update', $action);
        
        $validated = $request->validate([
            'result' => 'required|string',
        ]);
        
        $action->update([
            'result' => $validated['result']
        ]);
        
        return redirect()->route('customers.actions.show', [$customer, $action])->with('success', 'Result added successfully');
    }
}
