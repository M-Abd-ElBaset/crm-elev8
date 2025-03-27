<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Customer Details</h5>
                                        <div>
                                            <a href="{{ route('customers.edit', $customer) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">Name</dt>
                                            <dd class="col-sm-9">{{ $customer->name }}</dd>

                                            <dt class="col-sm-3">Email</dt>
                                            <dd class="col-sm-9">{{ $customer->email }}</dd>

                                            <dt class="col-sm-3">Phone</dt>
                                            <dd class="col-sm-9">{{ $customer->phone }}</dd>

                                            <dt class="col-sm-3">Assigned To</dt>
                                            <dd class="col-sm-9">
                                                {{ $customer->assignedEmployee?->name ?? 'Unassigned' }}</dd>

                                            <dt class="col-sm-3">Created By</dt>
                                            <dd class="col-sm-9">{{ $customer->creator->name }}</dd>

                                            <dt class="col-sm-3">Created At</dt>
                                            <dd class="col-sm-9">{{ $customer->created_at->format('M d, Y H:i') }}</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Actions</h5>
                                        <a href="{{ route('customers.actions.create', $customer) }}"
                                            class="btn btn-primary btn-sm">Add Action</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            @foreach ($customer->actions as $action)
                                                <a href="{{ route('actions.show', $action) }}" class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $action->type }}</h6>
                                                        <small>{{ $action->action_date->format('M d, Y') }}</small>
                                                    </div>
                                                    <p class="mb-1">{{ Str::limit($action->description, 100) }}</p>
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
