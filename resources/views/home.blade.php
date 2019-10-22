@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            @if (count(Auth::User()->todos) > 0)
              <!-- <span>Yay we have todos!</span> -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Completed</th>
                    <th scope="col">Due Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (Auth::User()->todos as $todo)
                    <tr>
                      <td>{{ $todo->title }}</td>
                      <td>{{ $todo->description }}</td>
                      <td>
                        @if ($todo->completed)
                          true
                        @else
                          false
                        @endif
                      </td>
                      <td>{{ $todo->due_date }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <span>We do not have any todos!</span>
            @endif
        </div>
    </div>
</div>
@endsection
