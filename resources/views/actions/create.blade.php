<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actions') }}
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
                                        {{ isset($action) ? 'Edit Action' : 'Create Action' }}
                                    </div>

                                    <div class="card-body">
                                        <form method="POST" 
                                            action="{{ isset($action) 
                                                ? route('customers.actions.update', [$customer, $action]) 
                                                : route('customers.actions.store', $customer) }}">
                                            @csrf
                                            @if(isset($action))
                                                @method('PUT')
                                            @endif

                                            <div class="mb-3">
                                                <label for="type" class="form-label">Type</label>
                                                <select class="form-select @error('type') is-invalid @enderror" 
                                                    id="type" name="type" required>
                                                    <option value="">Select Type</option>
                                                    <option value="call" {{ old('type', $action->type ?? '') == 'call' ? 'selected' : '' }}>
                                                        Call
                                                    </option>
                                                    <option value="meeting" {{ old('type', $action->type ?? '') == 'meeting' ? 'selected' : '' }}>
                                                        Meeting
                                                    </option>
                                                    <option value="email" {{ old('type', $action->type ?? '') == 'email' ? 'selected' : '' }}>
                                                        Email
                                                    </option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="action_date" class="form-label">Date</label>
                                                <input type="datetime-local" 
                                                    class="form-control @error('action_date') is-invalid @enderror" 
                                                    id="action_date" name="action_date" 
                                                    value="{{ old('action_date', isset($action) ? $action->action_date->format('Y-m-d\TH:i') : '') }}" 
                                                    required>
                                                @error('action_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                                    id="description" name="description" rows="3" required>{{ old('description', $action->description ?? '') }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ isset($action) ? 'Update Action' : 'Create Action' }}
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