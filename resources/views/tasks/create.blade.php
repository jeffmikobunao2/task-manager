@extends('layouts.app')

@section('title', 'Add Task')

@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Add New Task</h4>

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="task_name" class="form-label">Task Name</label>
                    <input type="text" name="task_name" id="task_name"
                           class="form-control" value="{{ old('task_name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Pending" selected>Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" name="due_date" id="due_date"
                               class="form-control" value="{{ old('due_date') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

@endsection
