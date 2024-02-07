@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body shadow">
                    <div class="mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Label</th>
                                    <th scope="col">Categories</th>
                                </tr>
                            </thead>
                            <!--  read data from database  -->
                            <tbody class="custom-tbody">
                                <tr>
                                    <th scope="row">{{ $ticket->id }}</th>
                                    <td>{{ $ticket->title }}</td>
                                    <td>{{ $ticket->description }}</td>
                                    <td>
                                        @foreach (explode(',', $ticket->image) as $imagePath)
                                            @php
                                                $fileName = basename($imagePath);
                                            @endphp
                                            {{-- <img src="{{ asset('storage/' . trim($imagePath)) }}" alt="Image"> --}}
                                            <img style="width:50px; height:50px"
                                                src="{{ asset('storage/gallery/' . trim($fileName)) }}" alt="Image">
                                        @endforeach
                                    </td>
                                    <td>{{ $ticket->priority->name }}</td>
                                    <td>{{ $ticket->label->name }}</td>
                                    <td>{{ $ticket->category->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-1 mt-3">
                            <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <h4>Comments</h4>
            <ul class="list-group">
                <!-- Display existing comments -->
                @foreach ($ticket->comments as $comment)
                    <li class="list-group-item text-between">
                        {{ $comment->text}}<br>
                        <span class=" text-warning ">
                            Comment by
                           {{ Auth::user()->name }}
                           @if (Auth::user()->role==0 ) <span class=" text-danger ">(Admin)</span> @elseif (Auth::user()->role==1) <span class=" text-danger ">(Agent)</span> @else <span class=" text-danger ">(User)</span> @endif
                           {{-- ({{ Auth::user()->role }}) --}}
                        </span>
                        <form method="POST" action="{{ route('comment.destroy',$comment->id) }}" class="d-inline-block">
                            @method('delete')
                            @csrf
                           <button href="" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                             <i class="fas fa-trash"></i>
                           </button>
                        </form>
                    </li>

                    
                @endforeach
            </ul>
        </div>
        <!-- Add Comment Form -->
        <form action="{{ route('comment.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <label for="comment" class="form-label">Add Comment</label>
                <textarea class="form-control" name="text" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <!-- End of Comment Section -->
        <div class="mb-1 mt-3">
            <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
        </div>

    @endsection
