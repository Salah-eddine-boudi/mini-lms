@php
    $layout = auth()->user()->isAdmin()
        ? 'layouts.admin'
        : (auth()->user()->isApprenant() ? 'layouts.apprenant' : 'layouts.app');
@endphp

@extends($layout)

@section('title', 'Mon profil')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mon profil</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-blue-50 px-6 py-6 border-b border-gray-200">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900">Mon profil</h3>
                            <p class="mt-1 text-sm text-slate-600">Mettez à jour vos informations personnelles.</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="h-16 w-16 rounded-full border border-slate-200 object-cover" />
                            <div class="text-sm text-slate-600">
                                <p class="font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 px-6 py-6">
                    <div class="rounded-3xl border border-gray-200 bg-slate-50 p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="rounded-3xl border border-gray-200 bg-slate-50 p-6">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="rounded-3xl border border-gray-200 bg-slate-50 p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
