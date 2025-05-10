<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .form-title {
            color: #3a3a3a;
            margin-bottom: 25px;
            font-weight: 600;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        .btn-submit {
            background-color: #4e73df;
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background-color: #3a5bd9;
        }
        .table-title {
            color: #3a3a3a;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .table th {
            background-color: #4e73df;
            color: white;
            font-weight: 500;
        }
        .table td {
            vertical-align: middle;
        }
        .action-btn {
            margin: 0 5px;
            padding: 5px 10px;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #1cc88a;
            color: white;
        }
        .btn-delete {
            background-color: #e74a3b;
            color: white;
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <h2 class="form-title"><i class="fas fa-user-plus me-2"></i>User Registration</h2>
                    <form action="{{route('tester')}}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter full name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required placeholder="Enter full address">
                        </div>
                        
                        <div class="form-group password-toggle">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
                            <span class="password-toggle-icon" onclick="togglePassword()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fas fa-save me-2"></i>Submit
                        </button>
                    </form>
                </div>
                
                <h2 class="table-title"><i class="fas fa-users me-2"></i>Registered Users</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($test as $tes)
                                <tr>
                                    <td>{{ $tes->id }}</td>
                                    <td>{{ $tes->name }}</td>
                                    <td>{{ $tes->address }}</td>
                                    <td>{{ $tes->email }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-edit action-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-delete action-btn">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.password-toggle-icon i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Confirm before delete
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this user?')) {
                    // Add your delete logic here
                    alert('User deleted successfully!');
                }
            });
        });
    </script>
</body>
</html>