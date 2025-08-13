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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>


</head>

<body>

    @auth
        <div class="container pt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="text-align: center"> My Notes</h2>
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
                        <div class="p-4 text-center text-muted"> You have no notes yet. <br> <br><a href="/viewCreate"
                                class="btn btn-success"><i class="fa fa-plus me-2"></i>Create your first note</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Note Subject</th>
                                        <th>Image</th>
                                        <th>Your Content</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $note->title }}</td>
                                           
                                            <td>
                                                @if ($note->image)
                                                    <img src="{{ asset('storage/' . $note->image) }}" alt="Note Image"
                                                        width="100">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            </td>

                                            <td>{{ $note->content }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('edit', $note->id) }}" class="btn btn-sm btn-primary me-2"
                                                    title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('delete', $note->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this note?')">
                                                        <i class="fa fa-trash-alt"></i>
                                                        <!--alt is to enhance good looking-->
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



{{-- 
What about asset('storage/' . $note->image)?
This is a Laravel helper used in Blade templates to generate a public URL for the stored image.

$note->image is the path relative to the storage folder, e.g., images/abc123.jpg.

Laravel stores files in storage/app/public, but this folder is not directly accessible by the browser.

You create a symbolic link from public/storage to storage/app/public using:

USING COMMAND LINE
php artisan storage:link
Now, public/storage is publicly accessible.

So, asset('storage/' . $note->image) generates a URL like:

means:

"Give me the full URL (including domain) to access the image file stored in the storage/app/public folder, via the public storage directory."
http://your-domain.com/storage/images/abc123.jpg
which points to the image file inside the public/storage/images folder. --}}



{{-- 
MOST IMPOSRTANT THING  ABOUT `asset('storage/' . $note->image)` relates to the database:;

### 1. What’s stored in the database?

In your `notes` table, the **`image` column** stores the **file path string** of the uploaded image, like:```images/myphoto.jpg```
This is just a **relative path**, **not a full URL**.

### 2. How do you display the image on a webpage?

* To display the image in your HTML, the browser needs a **public URL**.
* But the database only has the **path** (`images/myphoto.jpg`), not the URL.
* So, in your Blade view, you use:

```php
<img src="{{ asset('storage/' . $note->image) }}" alt="Note Image">```

* The `asset('storage/' . $note->image)` helper takes that relative path from the database and prepends your app’s URL plus `/storage/`, turning it into a full URL.

Example:
| Database image path  | Full public URL generated by asset()                 |
| -------------------- | ---------------------------------------------------- |
| `images/myphoto.jpg` | `http://your-app-url.com/storage/images/myphoto.jpg` |
---

3. Why?

* Laravel stores images physically on disk under `storage/app/public/images/myphoto.jpg`.
* The database just keeps track of **where** the image is saved by storing the relative path.
* The `asset()` helper turns that relative path into a URL your browser can request to **load and show** the image.---

--}}
