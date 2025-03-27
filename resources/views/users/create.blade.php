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
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        {{ isset($user) ? 'Edit Employee' : 'Create Employee' }}
                                    </div>

                                    <div class="card-body">
                                        <form method="POST" 
                                              action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
                                            @csrf
                                            @if(isset($user))
                                                @method('PUT')
                                            @endif

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" 
                                                       class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" 
                                                       name="name" 
                                                       value="{{ old('name', $user->name ?? '') }}" 
                                                       required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" 
                                                       name="email" 
                                                       value="{{ old('email', $user->email ?? '') }}" 
                                                       required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if(!isset($user))
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" 
                                                           class="form-control @error('password') is-invalid @enderror" 
                                                           id="password" 
                                                           name="password" 
                                                           required>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">
                                                        Confirm Password
                                                    </label>
                                                    <input type="password" 
                                                           class="form-control" 
                                                           id="password_confirmation" 
                                                           name="password_confirmation" 
                                                           required>
                                                </div>
                                            @endif

                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role</label>
                                                <select class="form-select @error('role') is-invalid @enderror" 
                                                        id="role" 
                                                        name="role" 
                                                        required>
                                                    <option value="">Select Role</option>
                                                    <option value="employee" 
                                                            {{ old('role', $user->role ?? '') == 'employee' ? 'selected' : '' }}>
                                                        Employee
                                                    </option>
                                                    <option value="admin" 
                                                            {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>
                                                        Administrator
                                                    </option>
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ isset($user) ? 'Update Employee' : 'Create Employee' }}
                                                </button>
                                            </div>
                                        </form>
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