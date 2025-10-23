<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Partner Odoo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white p-5">
  <div class="container">
    <h2 class="mb-4">Daftar Partner dari Odoo</h2>
    <p>Login sebagai: <strong>{{ session('odoo_user') }}</strong></p>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Telepon</th>
        </tr>
      </thead>
      <tbody>
        @forelse($partners as $p)
          <tr>
            <td>{{ $p['id'] }}</td>
            <td>{{ $p['name'] }}</td>
            <td>{{ $p['email'] ?? '-' }}</td>
            <td>{{ $p['phone'] ?? '-' }}</td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center">Tidak ada data partner.</td></tr>
        @endforelse
      </tbody>
    </table>

    <a href="{{ route('odoo.login.form') }}" class="btn btn-secondary mt-3">Logout</a>
  </div>
</body>
</html>
