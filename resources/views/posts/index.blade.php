<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-posts.header :title="'部落格文章'" />

        @session('success')
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endsession

        @session('error')
            <div class="alert alert-error mb-4">
                {{ session('error') }}
            </div>
        @endsession

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <x-posts.card :post="$post" />
            @endforeach
        </div>

        <x-posts.pagination :currentPage="1" />
    </div>
</x-layouts.app>
