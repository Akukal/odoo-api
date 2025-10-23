<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Odoo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-sky-500 via-indigo-500 to-purple-500 flex items-center justify-center px-4">
  <div class="w-full max-w-md">
    <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl p-8">
      <div class="flex flex-col items-center mb-6">
        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xl font-semibold mb-4">
          O
        </div>
        <h1 class="text-2xl font-semibold text-slate-900">Masuk ke Odoo</h1>
        <p class="text-slate-500 text-sm mt-1">Kelola data partner dengan mudah</p>
      </div>

      @if ($errors->any())
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('odoo.login') }}" class="space-y-5">
        @csrf
        <div>
          <label for="login" class="block text-sm font-medium text-slate-600 mb-1">Email</label>
          <input
            type="text"
            name="login"
            id="login"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100"
            placeholder="nama@perusahaan.com"
            required
          >
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-slate-600 mb-1">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100"
            placeholder="Masukkan password"
            required
          >
        </div>
        <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-3 text-sm font-medium text-white shadow-lg shadow-indigo-200 transition hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-4 focus:ring-indigo-200/70">
          Masuk Sekarang
        </button>
      </form>
    </div>
    <p class="mt-6 text-center text-xs text-white/80">
      © {{ date('Y') }} Integrasi Odoo. Semua hak dilindungi.
    </p>
  </div>
</body>
</html>
