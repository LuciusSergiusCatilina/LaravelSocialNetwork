@extends('layouts.layout')
@section('title','Main')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.success-message')
                @include('ideas.shared.submit-idea')
                <hr>
                @if (count($ideas) > 0)
                    @forelse ($ideas as $idea)
                        <div class="mt-3">
                            @include('ideas.shared.idea-card')
                        </div>
                        @empty
                        <p class = "text-center mt-4"> No Ideas...</p>
                    @endforelse
                @else
                    <p class="text-center mt-3">No ideas...</p>
                @endif
                <div class = "mt-3">
                    {{ $ideas->withQueryString()->links() }}
                </div>
            </div>
            <div class="col-3">
                @include('shared.search-bar')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
@endsection
