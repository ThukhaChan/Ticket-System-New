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
                       <h1> ticket Table</h1>
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
                          @foreach ($tickets as $ticket )
                          <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $ticket->name }}</td>
                            <td>@if ($ticket->role==0 ) Admin @elseif ($ticket->role==1) Agent @else ticket @endif</td>
                            <td>{{ $ticket->email }}</td>
                            <td>
                                <!-- font awesome & bootstrip icon -->
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('ticket.edit',$ticket->id) }}" class="btn btn-outline-warning me-1">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('ticket.destroy',$ticket->id) }}" class="d-inline-block">
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
