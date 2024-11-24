<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Anggota</h1>
        <form action="{{ route('members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Anggota</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $member->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Anggota</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $member->email }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Anggota</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
