<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Note</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    @auth
        <div class="container mt-5">
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="mb-4 text-center"> Create a New Note</h3>

                            <form action="/createNote" method="POST" enctype="multipart/form-data">                                                     
                                @csrf
                                <div class="mb-3">
                                    <label for="title">Note Title</label>
                                    <input type="text" name="title" class="form-control" required>

                                </div>

                                <div class="mb-3">
                                    <label for="content">Main Content</label>
                                    <textarea name="content" class="form-control" rows="6" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="image">Upload Image</label>
                                    <input type="file" name="image">
                                </div>
                                

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> Save Note
                                    </button>
                                    <a href="/home" class="btn btn-outline-danger"><i
                                            class="fa fa-arrow-left"></i>Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endauth

</body>

</html>
