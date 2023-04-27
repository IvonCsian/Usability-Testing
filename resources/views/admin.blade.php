<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manage Questions</title>
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
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;
			});
		} else{
			checkbox.each(function(){
				this.checked = false;
			});
		}
	});
	checkbox.click(function(){
		if(!this.checked){
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
                    <input type="submit"  class="btn btn-primary mt-1 mb-1" value="LOGOUT">
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
							<h2>Manage <b>Questions</b></h2>
						</div>
						<div class="col-xs-6">
							<a href="#addQuestionModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Question</span></a>
{{--							<a href="#deleteQuestionModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>--}}
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
							<th>Question</th>
							<th>Image Link</th>
							<th>x_start</th>
							<th>x_end</th>
                            <th>y_start</th>
							<th>y_end</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
                    @foreach ($questions as $question)
						<tr>
{{--							<td>--}}
{{--								<span class="custom-checkbox">--}}
{{--									<input type="checkbox" id="checkbox1" name="options[]" value="1">--}}
{{--									<label for="checkbox1"></label>--}}
{{--								</span>--}}
{{--							</td>--}}
                            <td>{{$question->id}}</td>
							<td>{{$question->question}}</td>
							<td>{{$question->question_img}}</td>
							<td>{{$question->x_start}}</td>
							<td>{{$question->x_end}}</td>
                            <td>{{$question->y_start}}</td>
                            <td>{{$question->y_end}}</td>
							<td>
								<a href="#editQuestionModal" class="edit" data-toggle="modal"
                                   data-id="{{ $question->id }}"
                                   data-question="{{ $question->question }}"
                                   data-question_img="{{ $question->question_img }}"
                                   data-x_start="{{ $question->x_start }}"
                                   data-x_end="{{ $question->x_end }}"
                                   data-y_start="{{ $question->y_start }}"
                                   data-y_end="{{ $question->y_end }}"> <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
								<a href="#deleteQuestionModal" class="delete" data-toggle="modal" data-id="{{ $question->id }}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
							</td>
						</tr>
                    @endforeach
					</tbody>
				</table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>{{ $questions->firstItem() }}</b> to <b>{{ $questions->lastItem() }}</b> of <b>{{ $questions->total() }}</b> entries</div>
                    {{ $questions->links('pagination::bootstrap-4', ['class' => 'pagination']) }}
                </div>
			</div>
		</div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addQuestionModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('admin.store') }}">
                    @csrf
					<div class="modal-header">
						<h4 class="modal-title">Add Question</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        <div class="form-group">
							<label>Question Number (ID)</label>
							<input type="number" name="id" id="id" value="{{ old('id') }}" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Question</label>
							<input type="text" name="question" id="question" value="{{ old('question') }}" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Question Image Link</label>
                            <textarea type="url" name="question_img" id="question_img" value="{{ old('question_img') }}" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Image  X-start Position</label>
							<input type="number" name="x_start" id="x_start" value="{{ old('x_start') }}" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Image  X-end Position</label>
							<input type="number" name="x_end" id="x_end" value="{{ old('x_end') }}" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Image  Y-start Position</label>
							<input type="number" name="y_start" id="y_start" value="{{ old('y_start') }}" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Image  Y-end Position</label>
							<input type="number" name="y_end" id="y_end" value="{{ old('y_end') }}" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editQuestionModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <form method="POST" action="{{ route('admin.update') }}">
                    @csrf
                    @method('PUT')
					<div class="modal-header">
						<h4 class="modal-title">Edit Question</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        <div class="form-group">
							<input type="hidden" id="question_idEdit" name="question_id" value="" required>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var questionIdEdit = $(this).data('id');
                                $("#question_idEdit").val( questionIdEdit );
                            });
                            </script>
						</div>
                        <div class="form-group">
                            <label>Question Number (ID)</label>
							<input type="number" id="id_edit" name="id" value="" class="form-control" required>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var idEdit = $(this).data('id');
                                $("#id_edit").val( idEdit );
                            });
                            </script>
						</div>
						<div class="form-group">
							<label>Question</label>
                            <input type="text" id="questionEdit" name="question" value="" class="form-control" required>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var question = $(this).data('question');
                                $("#questionEdit").val( question );
                            });
                            </script>
						</div>
						<div class="form-group">
							<label>Question Image Link</label>
                            <textarea type="url" id="question_imgEdit" name="question_img" value="" class="form-control" required></textarea>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var questionImg = $(this).data('question_img');
                                $("#question_imgEdit").val( questionImg );
                            });
                            </script>
						</div>
						<div class="form-group">
							<label>Image  X-start Position</label>
							<input type="number" id="x_startEdit" name="x_start" value="" class="form-control" required>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var xStart = $(this).data('x_start');
                                $("#x_startEdit").val( xStart );
                            });
                            </script>
						</div>
						<div class="form-group">
							<label>Image  X-end Position</label>
							<input type="number" id="x_endEdit" name="x_end" value="" class="form-control" required>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var xEnd = $(this).data('x_end');
                                $("#x_endEdit").val( xEnd );
                            });
                            </script>
						</div>
                        <div class="form-group">
							<label>Image  Y-start Position</label>
							<input type="number" id="y_startEdit" name="y_start" value="" class="form-control" required>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var yStart = $(this).data('y_start');
                                $("#y_startEdit").val( yStart );
                            });
                            </script>
						</div>
                        <div class="form-group">
							<label>Image  Y-end Position</label>
							<input type="number" id="y_endEdit" name="y_end" value="" class="form-control" required>
                            <script>
                            $(document).on("click", ".edit", function () {
                                var yEnd = $(this).data('y_end');
                                $("#y_endEdit").val( yEnd );
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
	<div id="deleteQuestionModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('admin.destroy') }}">
                    @csrf
                    @method('DELETE')
					<div class="modal-header">
						<h4 class="modal-title">Delete Question</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        <div class="form-group">
							<input type="hidden" id="question_id" name="question_id" value="" required>
                            <script>
                            $(document).on("click", ".delete", function () {
                                var questionId = $(this).data('id');
                                $("#question_id").val( questionId );
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
