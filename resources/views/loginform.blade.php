<x-layout>
    <div class="container height-full py-md-5">
        <div class="row align-items-center">
            <div class="col-lg-7 py-3 py-md-5">
                <h1 class="display-3">Mittagstisch</h1>
                <p class="lead text-muted"> Die Liste für unsere Lokalen Restaraunt, Genieße es!</p>
            </div>
            {{--<div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
                <form action="/register" method="POST" id="registration-form">
                    @csrf
                    <div class="form-group">
                        <label for="name-register" class="text-muted mb-1"><small>Name</small></label>
                        <input value="{{old('name')}}" name="name" id="username-register" class="form-control" type="text" placeholder="Dein voller Name" autocomplete="off" />
                        @error('name')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
                        <input value="{{old('email')}}" name="email" id="email-register" class="form-control" type="text" placeholder="you@example.com" autocomplete="off" />
                        @error('email')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-register" class="text-muted mb-1"><small>Passwort</small></label>
                        <input name="password" id="password-register" class="form-control" type="password" placeholder="Erstelle Passwort" />
                        @error('password')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-register-confirm" class="text-muted mb-1"><small>Bestätige Passwort</small></label>
                        <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Bestätige Passwort" />
                        @error('password_confirmation')
                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Jetzt Registrieren</button>
                </form>
            </div>--}}
        </div>
    </div>
</x-layout>
