<x-layout>

    @if($restaurants->count() == '0')
        <div class="container py-md-5 container--narrow">
            <div class="text-center">
                <h2 class="margin-b-20">Hello <strong>{{$user->name}}'s</strong> Restaurant List is empty.</h2>
                <form class="ml-2 d-inline" action="#" method="POST">
                    <a href="{{ route('user.restaurants.create', $user->id) }}"><div class="btn btn-primary btn-sm">Add Restaurant for this User &nbsp; <i class="fa fa-light fa-plus"></i></div></a>
                </form>
            </div>
        </div>

    @else

        <div class="container py-md-5 container--narrow">
            <h2>
                {{$user->name}}
                <form class="ml-2 d-inline" action="#" method="POST">
                    <a href="{{ route('user.restaurants.create', $user->id) }}"><div class="btn btn-primary btn-sm">Add Restaurant for this User &nbsp; <i class="fa fa-light fa-plus"></i></div></a>
                    <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
                </form>
            </h2>

            <div class="profile-nav nav nav-tabs remove-border pt-2 mb-4">
                <div class="profile-nav-link nav-item nav-link full-border active">Restaurants Hinzugefügt: {{$restaurants->count()}}</div>

            </div>

            <div class="list-group">
                        @foreach($restaurants as $restaurant)
                            <div class="list-group-item list-group-item-action">
                                <a href="{{ route('user.restaurants.show', ['user' => $user, 'restaurant' => $restaurant]) }}"><strong>{{$restaurant->name}}</strong></a> on {{$restaurant->created_at->format('n/j/y')}}
                               {{-- <a href="{{ route('user.restaurants.edit', ['user' => $user->id, 'restaurant' => $restaurant->id]) }}">Edit</a>--}}
                                <span class="pt-2">
                              <a href="{{ route('user.restaurants.edit', ['user' => $user->id, 'restaurant' => $restaurant->id]) }}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"> &nbsp;&nbsp;   <i class="fas fa-edit"></i></a>
                              <form class="delete-post-form d-inline" action="{{ route('user.restaurants.destroy', ['user' => $user, 'restaurant' => $restaurant]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                              </form>
                            </span>
                            </div>
                        @endforeach

            </div>
            <div class="pagination mt-2">
                {{ $restaurants->links() }}
            </div>
        </div>
    @endif
</x-layout>
