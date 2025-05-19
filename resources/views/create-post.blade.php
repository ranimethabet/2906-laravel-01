<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new post</title>
</head>

<body>

    <h1>Add Post</h1>

    <form action="/posts" method="POST">

        @csrf

        {{-- <input type="text" name="_token" value='<?= csrf_token(); ?>'> --}}
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title">

        </div>
        <div>
            <label for="body">body</label>
            <input type="text" id="body" name="body">

        </div>
        <div>
            <label for="status">status</label>
            <input type="number" id="status" name="status">
        </div>

        <div>
            <button>Add</button>
        </div>
    </form>
</body>

</html>