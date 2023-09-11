<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Date Filters Today Yesterday This Week Last Week This Month Last Month This Year Last Year</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
</head>
<body>
    <div class="container">
        <h1 class="text-center text-success pt-4">Laravel Date Filters Today Yesterday This Week Last Week This Month Last Month This Year Last Year</h1>
        <hr>
        <div class="row py-2">
            <div class="col-md-6">
                <h2>List of Employees</h3>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="date_filter">Filter by Date:</label>
                    <form method="get" action="employee">
                        <div class="input-group">
                            <select class="form-select" name="date_filter">
                                <option value="">All Dates</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="this_week">This Week</option>
                                <option value="last_week">Last Week</option>
                                <option value="this_month">This Month</option>
                                <option value="last_month">Last Month</option>
                                <option value="this_year">This Year</option>
                                <option value="last_year">Last Year</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <form id="deleteForm" action="{{ route('delete-all') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Selected</button>
            <table id="example" class="table table-bordered table-hover display">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkboxesMain"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Gender</th>
                        <th>E-mail</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="ids[]" value="{{ $employee->id }}"></td>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->gender }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
</body>
</html>
