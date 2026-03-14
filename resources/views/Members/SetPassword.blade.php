<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Set New Password | GBLDC</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>body{font-family:'Outfit',sans-serif;}</style>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
  <div class="w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-sm p-6">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-green-50 border border-green-200 text-green-700 flex items-center justify-center">
        <i class="fa-solid fa-key"></i>
      </div>
      <div>
        <div class="text-lg font-semibold text-slate-800">Set your new password</div>
        <div class="text-sm text-slate-500">Required on first login before accessing the dashboard.</div>
      </div>
    </div>

    @if ($errors->any())
      <div class="mt-4 rounded-xl border border-red-200 bg-red-50 text-red-700 p-3 text-sm">
        <div class="font-semibold mb-1">Please fix the following:</div>
        <ul class="list-disc ml-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('Member.Password.Set.Save') }}" class="mt-5 space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">New password</label>
        <input type="password" name="password" required autocomplete="new-password"
               class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400">
        <p class="text-xs text-slate-500 mt-1">Use at least 8 chars with upper/lowercase, number, and symbol.</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Confirm password</label>
        <input type="password" name="password_confirmation" required autocomplete="new-password"
               class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400">
      </div>
      <button type="submit" class="w-full rounded-xl bg-green-600 text-white font-semibold py-2.5 hover:bg-green-700 transition">
        Save password
      </button>
    </form>
  </div>
</body>
</html>

