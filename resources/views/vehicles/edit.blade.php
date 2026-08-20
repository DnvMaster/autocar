@extends('layouts.app')

@section('title', 'Редактирование автомобиля')


@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


    <div class="mb-8">


        <a
            href="{{ route('vehicles.show', $vehicle) }}"
            class="text-sm text-gray-500 hover:text-gray-900"
        >
            ← Назад к автомобилю
        </a>


        <h1 class="mt-3 text-2xl font-semibold text-gray-900">

            Редактирование:

            {{ $vehicle->brand }}
            {{ $vehicle->model }}

        </h1>


        <p class="mt-1 text-sm text-gray-500">

            Изменение данных автомобиля.

        </p>


    </div>



    <div class="bg-white border border-gray-200 rounded-xl p-6">


        <form
            method="POST"
            action="{{ route('vehicles.update', $vehicle) }}"
        >

            @csrf

            @method('PUT')


            @include('vehicles.form')


            <div class="mt-8 flex justify-end gap-3">


                <a
                    href="{{ route('vehicles.show', $vehicle) }}"
                    class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Отмена
                </a>


                <button
                    type="submit"
                    class="rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-800"
                >
                    Сохранить изменения
                </button>


            </div>


        </form>


    </div>


</div>


@endsection
