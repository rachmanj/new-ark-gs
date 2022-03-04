@extends('templates.main')

@section('title_page')
    Users
@endsection

@section('breadcrumb_title')
    users
@endsection

@section('content')
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Data</h3>
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-undo"></i> Back</a>
          </div>
          <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" value="{{ $user->username }}" class="form-control">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="project_code">Project</label>
              <select name="project_code" id="project_code" class="form-control">
                @foreach ($projects as $project)
                    <option value="{{ $project }}" {{ $project === $user->project_code ? 'selected' : '' }} >{{ $project }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="password_confirmation">Password Confirmation</label>
              <input type="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
              @error('password_confirmation')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection