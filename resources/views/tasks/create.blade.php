<!-- resources/views/tasks/create.blade.php -->

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Task Title" required>
    <textarea name="description" placeholder="Task Description" required></textarea>
    <button type="submit">Create Task</button>
</form>
