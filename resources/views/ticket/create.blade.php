@extends('dashboard.index')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5 shadow">
                    <div class="card-body m-3">
                        <div class="">
                            <h1 class="bg-gradient text-center">Ticket</h1>
                            @if (session('success'))
                                <div class=" alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label class="form-label">Title<small class="text-danger">*</small></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title')is-invalid @enderror" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">
                                            *{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label class="form-label">Description<small class="text-danger">*</small></label>
                                    <textarea  name="description"  class="form-control @error('description')is-invalid @enderror" value="{{ old('description') }}"></textarea>
                                    @error('description')
                                        <div class="text-danger">
                                            *{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 mt-3">
                                    <label  class="form-label">Choose Image<small class="text-danger">*</small></label>
                                    <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                                    @error('images')
                                     <div class="text-danger">
                                        *{{ $message }}
                                     </div>
                                    @enderror
                                </div>
                                <div class="mb-3 mt-3">
                                    <label  class="form-label">Priority<small class="text-danger">*</small></label>
                                    <select class="form-control" name="priority_id">
                                        @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}"
                                            @if($priority->id == old('priority_id')) selected @endif>
                                            {{ $priority->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('priority_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 mt-3">
                                  <label  class="form-label">Label<small class="text-danger">*</small></label><br>
                                  @foreach ($labels as $label)

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{ $label->id }}" name="label_id">
                                    <label class="form-check-label" for="inlineCheckbox1">
                                        @if($label->id == old('label_id')) selected @endif>
                                        {{ $label->name }}</label>
                                  </div>
                                  @endforeach
                                  
                                </div>
                                <div class="mb-3 mt-3">
                                    <label  class="form-label">Categories<small class="text-danger">*</small></label><br>
                                    @foreach ($categories as $category)
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{ $category->id }}" name="category_id">
                                      <label class="form-check-label" for="inlineCheckbox1">
                                        @if($category->id == old('category_id')) selected @endif>
                                        {{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                  </div>
                                <div class="mb-4">
                                    <a href="{{ route('ticket.index') }}" class="btn btn-outline-dark">Back</a>
                                    <button class="btn btn-outline-primary">Submit</button>
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
