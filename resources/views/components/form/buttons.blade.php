@props(['cancelRoute' => 'posts.index', 'cancelText' => '取消', 'submitText' => '提交'])

<div class="card-actions justify-end mt-6">
    <a href="{{ route($cancelRoute) }}" class="btn btn-sm">{{ $cancelText }}</a>
    <button type="submit" class="btn btn-sm btn-accent">{{ $submitText }}</button>
    {{ $slot }}
</div>
