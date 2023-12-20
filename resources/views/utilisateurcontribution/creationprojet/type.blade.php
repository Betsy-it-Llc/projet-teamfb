@extends('layouts.appwithtailwind')

@section('content')
<div class="bg-white">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-clack-900">Quel projet souhaitez vous créer ?</h1>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
            @foreach ($typesProjet as $type)
            <form method="post" action="{{ route('creation.type.post') }}">
                @csrf
                <input type="hidden" name="nom_type" value="{{ $type->valeur }}">
                <input type="hidden" name="type_id" value="{{ $type->id }}">
                <button type="submit">
                    <p class="text-xl text-center mb-2">{{ $type->valeur }}</p>
                    <div class="aspect-h-1 aspect-w-1 w-[250px] h-[150px] overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                        <img src="https://picsum.photos/seed/picsum/200/300" alt="{{ $type->valeur }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                    </div>
                </button>
            </form>
        @endforeach  


        </div>
    </div>
</div>
@endsection


