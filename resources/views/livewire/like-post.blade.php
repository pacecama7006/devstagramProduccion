<div>
    {{-- <h1>{{ $post->titulo }}</h1> --}}
    <div class="flex gap-2 items-center">
        {{-- Me traigo el botón de la vista show.blade y le quito el type="submit" --}}
        {{-- y le registro un evento que va a buscar una función en LikePost.php --}}
        <button wire:click="like">
            <svg class="w-6 h-6" fill="{{ $isLiked ? "red" : "white" }}"    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </button>

        {{-- Con la relación de post->likes, cuento los registros --}}
        <p class="font-bold"> 
            {{ $likes }} <span class="font-normal">likes</span>
        </p>
    </div>
</div>
