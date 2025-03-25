<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Customers</h5>
                                        <h2 class="card-text">{{ $customerCount }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Actions</h5>
                                        <h2 class="card-text">{{ $actionCount }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Recent Customers
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            @foreach($recentCustomers as $customer)
                                                <a href="{{ route('customers.show', $customer) }}" class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $customer->name }}</h6>
                                                        <small>{{ $customer->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="mb-1">Assigned to: {{ $customer->assignedEmployee?->name ?? 'Unassigned' }}</p>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Recent Actions
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            @foreach($recentActions as $action)
                                                <a href="{{ route('customers.actions.show', [$action->customer, $action]) }}" class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $action->type }}</h6>
                                                        <small>{{ $action->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="mb-1">Customer: {{ $action->customer->name }}</p>
                                                    <small>By: {{ $action->user->name }}</small>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
