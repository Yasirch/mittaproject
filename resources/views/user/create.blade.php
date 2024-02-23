<x-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text"  class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email"  class="form-control" value="{{ old('email') }}">
                        @error('email')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input type="password" id="password"  class="form-control" name="password">
                        @error('password')
                        <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" id="password_confirmation"  class="form-control" name="password_confirmation">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mr-2 margin-b-20">Create New User</button>
                    <a href="/login"><button class="btn btn-primary margin-b-20">Abbrechen</button></a>
                </form>
            </div>
        </div>
    </div>

</x-layout>
