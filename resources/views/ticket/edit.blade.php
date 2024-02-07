{{-- @extends('layouts.app') --}}
@extends('dashboard.index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
               <div class="card mt-5 shadow">
                <div class="card-body m-3">
                    <div class="">
                        <h1>Ticket</h1>
                        <form method="POST" action="{{ route('ticket.update',$ticket->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 mt-3">
                                <label  class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" value="{{ old('name',$ticket->title) }}">
                                @error('title')
                                    <div class="text-danget">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 mt-3">
                                <label  class="form-label">Description</label>
                                <input type="description" name="description" class="form-control @error('description')is-invalid @enderror" value="{{ old('description',$ticket->description) }}">
                                @error('description')
                                    <div class="text-danget">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 mt-3">
                                <label  class="form-label">Choose Image<small class="text-danger">*</small></label>
                                <br>
                                <img style="width:50px; height:50px" src="{{ asset('storage/gallery/'.$ticket->image) }}">
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            <div class="mb-3 mt-3">
                                <label class="form-label">Priority<small class="text-danger">*</small></label>
                                <select class="form-control" name="priority_id">
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}"
                                            @if ($priority->id == old('priority_id')) selected @endif>
                                            {{ $priority->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('priority_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 mt-3">
                                    <label class="form-label">Category<small class="text-danger">*</small></label>
                                    <select class="form-control" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($category->id == old('category_id')) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="mb-3 mt-3">
                                <label class="form-label">Label<small class="text-danger">*</small></label>
                                <select class="form-control" name="label_id">
                                    @foreach ($labels as $label)
                                        <option value="{{ $label->id }}"
                                            @if ($label->id == old('label_id')) selected @endif>
                                            {{ $label->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('label_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                            <div class="mb-4">
                                <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
                                <button class="btn btn-outline-primary">Update</button>
                            </div>
                        </form>
                    </div>
                 </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection