@extends('dashboard.index')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5 shadow">
                    <div class="card-body m-3">
                      <div class="mb-3">
                        @if (session('edit'))
                         <div class=" alert alert-warning">
                          {{ session('edit') }}
                         </div>
                       @endif
                       @if (session('update'))
                         <div class=" alert alert-success">
                           {{ session('update') }}
                         </div>
                       @endif
                       @if (session('delete'))
                          <div class=" alert alert-danger">
                             {{ session('delete') }}
                          </div>
                       @endif
                      </div>
                      <div class="d-flex justify-content-center"> <h1 class=""> User Table</h1>
                        {{-- <img  style="width:100px; height:100px" src={{ asset('dist/img/boy.svg') }} class="" alt="User Image"> --}}
                      </div>
                       <table class="table table-striped">
                        <thead class="custom-table">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Action</th>
                          </tr>
                        </thead>
    
                      <!--  read data from database  --> 
    
                        <tbody class="custom-tbody">
                          @foreach ($users as $user )
                          <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>@if ($user->role==0 ) Admin @elseif ($user->role==1) Agent @else User @endif</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <!-- font awesome & bootstrip icon -->
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-outline-warning me-1">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('user.destroy',$user->id) }}" class="d-inline-block ">
                                        @method('delete')
                                        @csrf
                                       <button href="" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                         <i class="fas fa-trash"></i>
                                       </button>
                                    </form>
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
