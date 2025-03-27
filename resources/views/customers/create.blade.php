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
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        {{ isset($customer) ? 'Edit Customer' : 'Create Customer' }}</div>

                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ isset($customer) ? route('customers.update', $customer) : route('customers.store') }}">
                                            @csrf
                                            @if (isset($customer))
                                                @method('PUT')
                                            @endif

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" name="name"
                                                    value="{{ old('name', $customer->name ?? '') }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email"
                                                    value="{{ old('email', $customer->email ?? '') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    id="phone" name="phone"
                                                    value="{{ old('phone', $customer->phone ?? '') }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if (Auth::user()->isAdmin())
                                                <div class="mb-3">
                                                    <label for="assigned_to" class="form-label">Assign To</label>
                                                    <select
                                                        class="form-select @error('assigned_to') is-invalid @enderror"
                                                        id="assigned_to" name="assigned_to">
                                                        <option value="">Select Employee</option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}"
                                                                {{ old('assigned_to', $customer->assigned_to ?? '') == $employee->id ? 'selected' : '' }}>
                                                                {{ $employee->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('assigned_to')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ isset($customer) ? 'Update Customer' : 'Create Customer' }}
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
