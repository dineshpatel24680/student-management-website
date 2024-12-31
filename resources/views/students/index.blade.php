@extends('layouts.app')

@section('content')
    <h1>Students</h1>
    <a href="/students/create" class="btn btn-primary mb-3">Add New Student</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentsTableBody">
            <!-- Students will be loaded here dynamically -->
        </tbody>
    </table>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/students')
        .then(response => response.json())
        .then(students => {
            const tableBody = document.getElementById('studentsTableBody');
            students.forEach(student => {
                const row = `
                    <tr>
                        <td>${student.id}</td>
                        <td>${student.name}</td>
                        <td>${student.email}</td>
                        <td>
                            <a href="/students/${student.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                            <button onclick="deleteStudent(${student.id})" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        });
});

function deleteStudent(id) {
    if (confirm('Are you sure you want to delete this student?')) {
        fetch(`/api/students/${id}`, { method: 'DELETE' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to delete student');
                }
            });
    }
}
</script>
@endsection

