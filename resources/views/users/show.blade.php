<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
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
                                        <h5 class="mb-0">Employee Details</h5>
                                        @if(Auth::user()->isAdmin())
                                        <div>
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">Name</dt>
                                            <dd class="col-sm-9">{{ $user->name }}</dd>

                                            <dt class="col-sm-3">Email</dt>
                                            <dd class="col-sm-9">{{ $user->email }}</dd>

                                            <dt class="col-sm-3">Role</dt>
                                            <dd class="col-sm-9">{{ ucfirst($user->role) }}</dd>

                                            <dt class="col-sm-3">Joined</dt>
                                            <dd class="col-sm-9">{{ $user->created_at->format('M d, Y H:i') }}</dd>

                                            <dt class="col-sm-3">Assigned Customers</dt>
                                            <dd class="col-sm-9">{{ $user->assignedCustomers()->count() }}</dd>

                                            <dt class="col-sm-3">Actions Created</dt>
                                            <dd class="col-sm-9">{{ $user->actions()->count() }}</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Assigned Customers</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            @foreach ($user->assignedCustomers as $customer)
                                                <a href="{{ route('customers.show', $customer) }}"
                                                    class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $customer->name }}</h6>
                                                        <small>{{ $customer->created_at->format('M d, Y') }}</small>
                                                    </div>
                                                    <p class="mb-1">
                                                        <i class="bi bi-envelope"></i> {{ $customer->email }}
                                                        <span class="mx-2">|</span>
                                                        <i class="bi bi-telephone"></i> {{ $customer->phone }}
                                                    </p>
                                                    <small>Actions: {{ $customer->actions()->count() }}</small>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Recent Actions</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group">
                                            @foreach ($user->actions()->latest()->take(5)->get() as $action)
                                                <a href="{{ route('customers.actions.show', [$action->customer, $action]) }}"
                                                    class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ ucfirst($action->type) }}</h6>
                                                        <small>{{ $action->action_date->format('M d, Y') }}</small>
                                                    </div>
                                                    <p class="mb-1">{{ Str::limit($action->description, 50) }}</p>
                                                    <small>Customer: {{ $action->customer->name }}</small>
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