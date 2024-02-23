<x-layout>

    @if($restaurants->count() == '0' && !auth()->user()->isAdmin())
        <div class="container py-md-5 container--narrow">
            <div class="text-center">
                <h2 class="margin-b-20">Hello <strong>{{$username}}</strong>, Ihre Restaurantliste ist leer.</h2>

               {{-- <form class="ml-2 d-inline" action="#" method="POST">
                    <a href="/restaurant"><div class="btn btn-primary btn-sm">Restaraunt Hinzufügen &nbsp; <i class="fa fa-light fa-plus"></i></div></a>
                </form> --}}
            </div>
        </div>

    @else

    <div class="container py-md-5 container--narrow">
        <h2>
            {{$username}}
            @if( auth()->user()->isAdmin())
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                Add New User &nbsp; <i class="fa fa-light fa-plus"></i>
            </a>
            @endif
            {{-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> --}}
        </h2>

        <div class="profile-nav nav nav-tabs remove-border pt-2 mb-4">
            <div class="profile-nav-link nav-item nav-link full-border active">Gesamtbenutzer:  {{ $count }}</div>

        </div>

        <div class="list-group">
            @auth
                @if(auth()->user()->is_admin)
                    @foreach($nonAdminUsers as $nonAdminUsers)
                        <div class="list-group-item list-group-item-action">
                            <a href="{{ route('user.restaurants', $nonAdminUsers->id) }}"><strong>{{$nonAdminUsers->name}}</strong></a> - {{$nonAdminUsers->email}}  | created on {{$nonAdminUsers->created_at->format('n/j/y')}}
                            <span class="pt-2">
                              <a href="{{ route('user.edit', $nonAdminUsers->id) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"> &nbsp;&nbsp;   <i class="fas fa-edit"></i></a>
                              <form class="delete-post-form d-inline" action="{{ route('user.destroy', ['user' => $nonAdminUsers]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                              </form>
                            </span>
                        </div>
                    @endforeach
                @else
                    @foreach($restaurants as $restaurant)
                        <div class="list-group-item list-group-item-action">
                            <a href="/restaurant/{{$restaurant->id}}"><strong>{{$restaurant->name}}</strong></a> on {{$restaurant->created_at->format('n/j/y')}}
                        </div>
                    @endforeach
                @endif
            @endauth



        </div>
        <div class="pagination mt-2">
            {{ $restaurants->links() }}
        </div>
    </div>
    @endif
</x-layout>
