@extends('layouts.app')

@section('title', 'Personal Task Manager')

@section('content')

    <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
        <div>
            <h2 class="fw-bold mb-1">Personal Task Manager</h2>
            <p class="text-muted mb-0">Stay organized and keep track of your work.</p>
        </div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add Task</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-number">{{ $total }}</div>
                    <div class="stat-label">Total Tasks</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-number">{{ $pending }}</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-number">{{ $completed }}</div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold mb-3">My Tasks</h5>

    <div class="card">
        <div class="card-body">

            @if ($tasks->isEmpty())
                <div class="text-center py-5">
                    <h5 class="fw-bold mb-2">No tasks yet</h5>
                    <p class="text-muted mb-3">Your task list is empty. Create your first task to get started.</p>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Create Your First Task</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th style="width: 260px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->task_name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($task->description, 40) }}</td>
                                    <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : '—' }}</td>
                                    <td>
                                        <span class="badge {{ $task->status === 'Completed' ? 'badge-completed' : 'badge-pending' }}">
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                @if ($task->status === 'Pending')
                                                    <input type="hidden" name="status" value="Completed">
                                                    <button type="submit" class="btn btn-sm btn-success">Mark Done</button>
                                                @else
                                                    <input type="hidden" name="status" value="Pending">
                                                    <button type="submit" class="btn btn-sm btn-warning">Mark Pending</button>
                                                @endif
                                            </form>
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                  onsubmit="return confirm('Delete this task? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

@endsection