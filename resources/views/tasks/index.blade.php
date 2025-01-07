<!-- resources/views/tasks/index.blade.php -->

<form method="GET" action="{{ route('tasks.index') }}">
    <input type="text" name="search" placeholder="Search tasks" value="{{ request('search') }}">
    <select name="status">
        <option value="">All Statuses</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    <button type="submit">Search</button>
</form>

<h2>Task List</h2>

@foreach ($tasks as $task)
    <div>
        <p>{{ $task->title }} - Status: {{ $task->status }}</p>
        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <select name="status" onchange="this.form.submit()">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>
        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach

<a href="{{ route('tasks.create') }}">Add New Task</a>
