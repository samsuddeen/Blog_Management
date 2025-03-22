<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('profile.edit') }}" class="text-sm text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Profile
                </span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Card -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="md:w-1/3 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-lg shadow-sm">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-3 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Profile</h3>
                            </div>
                            <p class="text-gray-600 mb-4 text-sm">Manage your profile information here.</p>
                            <ul class="space-y-3">
                                <li class="flex items-center p-3 bg-white rounded-md shadow-sm">
                                    <span class="text-gray-700 font-medium min-w-24">Name:</span>
                                    <span class="text-gray-800 ml-2">{{ Auth::user()->name }}</span>
                                </li>
                                <li class="flex items-center p-3 bg-white rounded-md shadow-sm">
                                    <span class="text-gray-700 font-medium min-w-24">Email:</span>
                                    <span class="text-gray-800 ml-2">{{ Auth::user()->email }}</span>
                                </li>
                                <li class="flex items-center p-3 bg-white rounded-md shadow-sm">
                                    <span class="text-gray-700 font-medium min-w-24">Role:</span>
                                    <span class="text-gray-800 ml-2">
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            {{ Auth::user()->role }}
                                        </span>
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="md:w-2/3">
                            <div class="flex items-center mb-6">
                                <div class="bg-indigo-100 p-3 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Recent Blog Posts</h3>
                            </div>

                            @if($recentBlogs->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($recentBlogs as $blog)
            <div class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 ease-in-out hover:shadow-lg">
                <div class="h-48 overflow-hidden">
                    <img
                        src="{{ asset($blog->image ?? '') }}"
                        alt="{{ $blog->title }}"
                        class="w-full h-full object-cover transition duration-300 ease-in-out hover:scale-105"
                    >
                </div>
                <div class="p-4">
                    <h4 class="font-medium text-lg text-gray-800 hover:text-blue-600 transition duration-300 ease-in-out">
                        <a href="#">{{ $blog->title ?? '' }}</a>
                    </h4>
                    <div class="mt-2 text-sm text-gray-600 line-clamp-2 overflow-hidden">
                        {!! Str::limit(strip_tags($blog->content), 100) !!}
                    </div>
                    <div class="flex items-center text-xs text-gray-500 mt-3">
                        @if($blog->category)
                            <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded-full mr-2">
                                {{ $blog->category->name }}
                            </span>
                        @endif
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $blog->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach

                                </div>
                            @else
                                <div class="bg-white p-8 rounded-lg shadow text-center">
                                    <div class="text-indigo-400 mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-lg mb-4">No blog posts yet.</p>
                                    {{-- <a href="{{ route('blog.create') }}" class="inline-block px-6 py-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition duration-300 ease-in-out">
                                        Create Your First Blog
                                    </a> --}}
                                </div>
                            @endif

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $recentBlogs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
