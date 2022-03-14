
@extends('layout')
@section('content')
<section id="local_users">
    <div class=" card users-container mx-auto">
        <table class="table table-custom">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $users as $user)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                    </tr>
                @endforeach
              </tbody>
        </table>
    </div>
</section>
@endsection