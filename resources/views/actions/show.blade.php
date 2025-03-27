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
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Action Details</h5>
                                        <div>
                                            <a href="{{ route('customers.actions.edit', [$customer, $action]) }}" 
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('customers.actions.destroy', [$customer, $action]) }}" 
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row">
                                            <dt class="col-sm-3">Type</dt>
                                            <dd class="col-sm-9">{{ ucfirst($action->type) }}</dd>

                                            <dt class="col-sm-3">Date</dt>
                                            <dd class="col-sm-9">{{ $action->action_date->format('M d, Y H:i') }}</dd>

                                            <dt class="col-sm-3">Customer</dt>
                                            <dd class="col-sm-9">
                                                <a href="{{ route('customers.show', $customer) }}">{{ $customer->name }}</a>
                                            </dd>

                                            <dt class="col-sm-3">Created By</dt>
                                            <dd class="col-sm-9">{{ $action->user->name }}</dd>

                                            <dt class="col-sm-3">Description</dt>
                                            <dd class="col-sm-9">{{ $action->description }}</dd>

                                            @if($action->result)
                                                <dt class="col-sm-3">Result</dt>
                                                <dd class="col-sm-9">{{ $action->result }}</dd>
                                            @endif
                                        </dl>

                                        @if(!$action->result)
                                            <form action="{{ route('customers.actions.add-result', [$customer, $action]) }}" 
                                                method="POST" class="mt-4">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="result" class="form-label">Add Result</label>
                                                    <textarea class="form-control @error('result') is-invalid @enderror" 
                                                        id="result" name="result" rows="3" required></textarea>
                                                    @error('result')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Result</button>
                                            </form>
                                        @endif
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