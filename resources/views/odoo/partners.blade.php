<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Partner Odoo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="min-h-screen bg-slate-100">
  <div class="relative bg-gradient-to-br from-indigo-500 via-purple-500 to-sky-500 mb-8">
    <div class="mx-auto max-w-6xl px-6 py-14 text-white">
      <div class="flex flex-wrap items-center justify-between gap-6">
        <div>
          <p class="text-sm uppercase tracking-[0.35em] text-white/70">Dashboard</p>
          <h1 class="mt-3 text-3xl font-semibold">Daftar Partner Odoo</h1>
          <p class="mt-2 text-sm text-white/80">Lihat dan kelola data partner yang tersinkron dari sistem Odoo Anda.</p>
        </div>
        <div class="flex items-center gap-3">
          <div class="rounded-full bg-white/20 px-4 py-2 text-sm">{{ session('odoo_user') }}</div>
          <a
            href="{{ route('odoo.login.form') }}"
            class="rounded-full border border-white/40 px-5 py-2 text-sm font-medium text-white transition hover:border-white hover:bg-white/10"
          >
            Keluar
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="mx-auto max-w-6xl -mt-34 px-6 pb-16">
    <div class="overflow-hidden rounded-3xl bg-white shadow-xl shadow-indigo-100/40">
      <div class="border-b border-slate-100 px-6 py-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <div>
            <h2 class="text-xl font-semibold text-slate-900">Partner Terdaftar</h2>
            <p class="text-sm text-slate-500">{{ count($partners) }} partner ditemukan.</p>
          </div>
          <form method="GET" class="flex items-center gap-3 text-sm text-slate-500">
            <input
              type="text"
              name="q"
              value="{{ request('q') }}"
              placeholder="Cari nama atau email"
              class="w-56 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100"
            >
            <button
              type="submit"
              class="rounded-2xl bg-indigo-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-600 focus:outline-none focus:ring-4 focus:ring-indigo-200/70"
            >
              Cari
            </button>
          </form>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
          <thead class="bg-slate-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">ID</th>
              <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Nama</th>
              <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Email</th>
              <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-400">Telepon</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 bg-white">
            @forelse($partners as $p)
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $p['id'] }}</td>
                <td class="px-6 py-4 text-sm text-slate-700">{{ $p['name'] }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $p['email'] ?? '-' }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $p['phone'] ?? '-' }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">Tidak ada data partner.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
