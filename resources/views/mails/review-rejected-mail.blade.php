<div class="max-w-xl mx-auto my-10 bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
    <!-- Top Bar -->
    <div class="px-6 py-5 bg-gray-900">
        <p class="text-sm text-gray-300">{{ config('app.name') }}</p>
        <h2 class="mt-1 text-2xl font-semibold text-white">Review Rejected</h2>
    </div>

    <div class="p-6 text-gray-800">
        <p class="mb-4">
            Hi <span class="font-semibold text-gray-900">{{ $review->user->name }}</span>,
        </p>

        <p class="mb-5 leading-relaxed">
            Thanks for taking the time to share your experience. Unfortunately, your review for
            <span class="font-semibold text-gray-900">{{ $review->place->name }}</span>
            was <span class="font-semibold text-red-600">rejected</span> by our moderation team.
        </p>

        <!-- Reason / Guidelines -->
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 mb-6">
            <p class="text-sm font-semibold text-red-700 mb-1">Why this happened</p>
            <p class="text-sm text-red-700 leading-relaxed">
                Your review didn’t align with our community guidelines.
                @if(!empty($review->rejection_reason))
                <span class="block mt-2">
                    <span class="font-semibold">Reason:</span> {{ $review->rejection_reason }}
                </span>
                @endif
            </p>
        </div>

        <!-- Next steps -->
        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 mb-6">
            <p class="text-sm font-semibold text-gray-900 mb-1">What you can do next</p>
            <ul class="text-sm text-gray-700 list-disc pl-5 space-y-1">
                <!-- <li>Edit your review to match the guidelines and submit again.</li> -->
                <li>If you think this was a mistake, you can appeal by contacting support.</li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3">
            @if(!empty($editUrl))
            <a href="{{ $editUrl }}"
                class="inline-flex justify-center items-center px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-500 transition">
                ✍️ Edit & Resubmit
            </a>
            @endif

            <a href="mailto:support@example.com"
                class="inline-flex justify-center items-center px-5 py-3 rounded-lg bg-white border border-gray-300 text-gray-900 font-semibold hover:bg-gray-100 transition">
                Contact Support
            </a>
        </div>

        <p class="mt-8 text-sm text-gray-500 leading-relaxed">
            Thank you for being part of our community,<br>
            — The {{ config('app.name') }} Team
        </p>
    </div>
</div>