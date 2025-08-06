<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes Dashboard</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
       

</head>

<body>

    @auth
        <div class="container pt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2  style="text-align: center"> My Notes</h2>
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa fa-sign-out-alt "></i> Logout
                    </button>
                </form>
            </div>

          
            <div class="mb-4">
                <a href="/viewCreate" class="btn btn-success">
                    <i class="fa fa-plus me-1"></i> Create New Note
                </a>
            </div>

         
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    @if ($notes->isEmpty())
                        <div class="p-4 text-center text-muted"> You have no notes yet. <br> <br><a href="/viewCreate" class="btn btn-success"><i class="fa fa-plus me-2"></i>Create your first note</a>
                           
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Note Subject</th>
                                        <th>Your Content</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $note->title }}</td>
                                            <td>{{ $note->content }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('edit', $note->id) }}" class="btn btn-sm btn-primary me-2" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('delete', $note->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this note?')">
                                                        <i class="fa fa-trash-alt"></i> <!--alt is to enhance good looking-->
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    @endauth

</body>

</html>
