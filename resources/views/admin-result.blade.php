<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Results</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }
    </style>
    <script>
        $(document).ready(function () {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function () {
                if (this.checked) {
                    checkbox.each(function () {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function () {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function () {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Admin<b>Page</b></a>
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="/admin">Questions</a></li>
            <li><a href="/admin-result">Results</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <form method="POST" action="/auth/admin/logout">
                @csrf
                <input type="submit" class="btn btn-primary mt-1 mb-1" value="LOGOUT">
            </form>
        </ul>
    </div>
</nav>
<div class="container">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-6">
                        <h2>Manage <b>Results</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    {{--							<th>--}}
                    {{--								<span class="custom-checkbox">--}}
                    {{--									<input type="checkbox" id="selectAll">--}}
                    {{--									<label for="selectAll"></label>--}}
                    {{--								</span>--}}
                    {{--							</th>--}}
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Question Number</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($results as $result)
                    <tr>
                        {{--							<td>--}}
                        {{--								<span class="custom-checkbox">--}}
                        {{--									<input type="checkbox" id="checkbox1" name="options[]" value="1">--}}
                        {{--									<label for="checkbox1"></label>--}}
                        {{--								</span>--}}
                        {{--							</td>--}}
                        <td>{{$result->id}}</td>
                        <td>{{$result->user->name}}</td>
                        <td>{{$result->question_id}}</td>
                        <td>{{$result->time}}&emsp;Second(s)</td>
                        <td>
                            <a href="#editResultModal" class="edit" data-toggle="modal"
                               data-id="{{ $result->id }}"
                               data-user_id="{{ $result->user_id }}"
                               data-question_id="{{ $result->question_id }}"
                               data-time="{{ $result->time }}">
                                <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                            </a>
                            <a href="#deleteResultModal" class="delete" data-toggle="modal"
                               data-id="{{ $result->id }}">
                                <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Showing <b>{{ $results->firstItem() }}</b> to <b>{{ $results->lastItem() }}</b>
                    of <b>{{ $results->total() }}</b> entries
                </div>
                {{ $results->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal HTML -->
<div id="editResultModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin-result.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h4 class="modal-title">Edit Result</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="resultIdEdit" name="result_id" value="" required>
                        <script>
                            $(document).on("click", ".edit", function () {
                                var resultId = $(this).data('id');
                                $("#resultIdEdit").val(resultId);
                            });
                        </script>
                    </div>
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="number" id="userIdEdit" name="user_id" value="" class="form-control" required>
                        <script>
                            $(document).on("click", ".edit", function () {
                                var userId = $(this).data('user_id');
                                $("#userIdEdit").val(userId);
                            });
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Question ID</label>
                        <input type="text" id="questionIdEdit" name="question_id" value="" class="form-control" required>
                        <script>
                            $(document).on("click", ".edit", function () {
                                var questionId = $(this).data('question_id');
                                $("#questionIdEdit").val(questionId);
                            });
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <textarea type="url" id="timeEdit" name="time" value="" class="form-control"
                                  required></textarea>
                        <script>
                            $(document).on("click", ".edit", function () {
                                var time = $(this).data('time');
                                $("#timeEdit").val(time);
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteResultModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin-result.destroy') }}">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Delete Result</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="result_id" name="result_id" value="" required>
                        <script>
                            $(document).on("click", ".delete", function () {
                                var resultId = $(this).data('id');
                                $("#result_id").val(resultId);
                            });
                        </script>
                    </div>
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
