 <div class="max-w-xl mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
     <h2 class="text-2xl font-semibold text-red-600 mb-4">Review Rejected</h2>

     <p class="mb-4">Hi <span class="font-medium text-gray-900">{{ $review->user->name }}</span>,</p>

     <p class="mb-4">
         We regret to inform you that your review for
         <span class="font-semibold text-gray-900">{{ $review->place->name }}</span>
         has been <span class="text-red-600 font-semibold">rejected</span> by our moderation team.
     </p>

     <div class="bg-red-50 border border-red-200 p-4 rounded mb-4">
         <p class="text-sm text-red-700">
             This action was taken because your review did not align with our community guidelines.
         </p>
     </div>

     <p class="mb-4">
         If you believe this decision was made in error or would like to appeal, please don’t hesitate to
         <a href="mailto:support@example.com" class="text-blue-600 hover:underline">contact our support team</a>.
     </p>

     <p class="mt-6 text-sm text-gray-500">
         Thank you for being a part of our community,<br>
         — The {{ config('app.name') }} Team
     </p>
 </div>