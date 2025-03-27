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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Employees</h2>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('users.create') }}" class="btn btn-primary">Add Employee</a>
                            @endif
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Customers Count</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ ucfirst($user->role) }}</td>
                                                <td>{{ $user->assignedCustomers()->count() }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('users.show', $user) }}" 
                                                           class="btn btn-sm btn-info">View</a>
                                                        @if(Auth::user()->isAdmin())
                                                            <a href="{{ route('users.edit', $user) }}" 
                                                               class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('users.destroy', $user) }}" 
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-sm btn-danger" 
                                                                        onclick="return confirm('Are you sure?')">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>