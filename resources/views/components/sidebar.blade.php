 <!-- Sidebar -->
 <aside class="w-64 bg-white shadow-md p-4 flex flex-col">
     <div class="text-2xl font-bold mb-6">Tourist Guide</div>
     <nav class="flex-1 space-y-2">
         <a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Dashboard</a>
         <a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Users</a>
         <a href="{{route('admin.places.index')}}" class="block py-2 px-4 rounded hover:bg-gray-200">Places</a>
         <a href="{{route('admin.categories.index')}}" class="block py-2 px-4 rounded hover:bg-gray-200">Categories</a>
         <a href="{{route('admin.reviews.index')}}" class="block py-2 px-4 rounded hover:bg-gray-200">Reviews</a>
         <a href="#" class="block py-2 px-4 rounded hover:bg-gray-200">Settings</a>
     </nav>
     <form method="POST" action="">
         @csrf
         <button type="submit" class="py-2 px-4 w-full bg-red-500 text-white rounded mt-4 hover:bg-red-600">
             Logout
         </button>
     </form>
 </aside>