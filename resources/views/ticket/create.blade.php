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
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    @error('image')
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
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">bug</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">question</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">enhancement</label>
                                  </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label  class="form-label">Categories<small class="text-danger">*</small></label><br>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                      <label class="form-check-label" for="inlineCheckbox1">Uncategorized</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                      <label class="form-check-label" for="inlineCheckbox2">Billing/payment</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                      <label class="form-check-label" for="inlineCheckbox2">Technical question</label>
                                    </div>
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
