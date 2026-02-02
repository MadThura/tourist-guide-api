<x-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Send Email to Users</h1>
                <p class="text-sm text-gray-500 dark:text-gray-300">
                    From: <span class="font-semibold">{{ $setting->app_name ?? config('app.name') }}</span>
                    @if(!empty($setting->contact_email))
                    • Reply-To: <span class="font-semibold">{{ $setting->contact_email }}</span>
                    @endif
                </p>
            </div>

            @if(!empty($setting?->logo))
            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="h-12 rounded bg-white p-1">
            @endif
        </div>

        <form action="{{ route('admin.emails.send') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Audience --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Send To</label>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <label class="flex items-center gap-2 p-3 border rounded bg-white dark:bg-gray-700 dark:border-gray-600">
                        <input type="radio" name="audience" value="users_only" class="accent-blue-600"
                            {{ old('audience', 'users_only') === 'users_only' ? 'checked' : '' }}>
                        <span class="text-sm text-gray-800 dark:text-gray-100">Users (role = user)</span>
                    </label>

                    <label class="flex items-center gap-2 p-3 border rounded bg-white dark:bg-gray-700 dark:border-gray-600">
                        <input type="radio" name="audience" value="all" class="accent-blue-600"
                            {{ old('audience') === 'all' ? 'checked' : '' }}>
                        <span class="text-sm text-gray-800 dark:text-gray-100">All accounts</span>
                    </label>

                    <label class="flex items-center gap-2 p-3 border rounded bg-white dark:bg-gray-700 dark:border-gray-600">
                        <input type="radio" name="audience" value="specific" class="accent-blue-600"
                            {{ old('audience') === 'specific' ? 'checked' : '' }}>
                        <span class="text-sm text-gray-800 dark:text-gray-100">Specific emails</span>
                    </label>
                </div>

                <p class="mt-2 text-xs text-gray-500 dark:text-gray-300">
                    “Users (role=user)” excludes superadmin/admin/moderator automatically.
                </p>
            </div>

            {{-- Specific emails --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Specific Emails (comma-separated)
                </label>
                <input type="text" name="emails"
                    value="{{ old('emails') }}"
                    placeholder="example1@gmail.com, example2@gmail.com"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                    Only used when “Specific emails” is selected.
                </p>
            </div>

            {{-- Subject --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subject</label>
                <input type="text" name="subject" value="{{ old('subject') }}"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                    placeholder="Important update from {{ $setting->app_name ?? config('app.name') }}" required>
            </div>

            {{-- Message --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message</label>
                <textarea name="message" rows="8"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                    placeholder="Write your message to users..." required>{{ old('message') }}</textarea>
            </div>

            {{-- Optional CTA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Button Text (optional)</label>
                    <input type="text" name="button_text" value="{{ old('button_text') }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        placeholder="Open App / View Place / Learn More">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Button Link (optional)</label>
                    <input type="url" name="button_url" value="{{ old('button_url') }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        placeholder="https://your-site.com/...">
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-3">
                <button type="reset"
                    class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 px-6 py-2 rounded">
                    Clear
                </button>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    Send Email
                </button>
            </div>
        </form>
    </div>
</x-layout>