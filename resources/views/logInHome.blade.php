<x-layout>

    @if($restaurants->count() == '0')
        <div class="container py-md-5 container--narrow">
            <div class="text-center">
                <h2 class="margin-b-20">Hello <strong>{{$username}}</strong>, your Restaurant List is empty.</h2>
                <form class="ml-2 d-inline" action="#" method="POST">
                    <a href="/restaurant"><div class="btn btn-primary btn-sm">Restaraunt Hinzufügen &nbsp; <i class="fa fa-light fa-plus"></i></div></a>
                </form>
            </div>
        </div>

    @else

    <div class="container py-md-5 container--narrow">
        <h2>
            {{$username}}
            <form class="ml-2 d-inline" action="#" method="POST">
                <a href="/restaurant"><div class="btn btn-primary btn-sm">Restaraunt Hinzufügen &nbsp; <i class="fa fa-light fa-plus"></i></div></a>
                <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
            </form>
        </h2>

        <div class="profile-nav nav nav-tabs remove-border pt-2 mb-4">
            <div class="profile-nav-link nav-item nav-link full-border active">Restaurants Added: {{$count}}</div>

        </div>

        <div class="list-group">

            @foreach($restaurants as $restaurant)
                <div class="list-group-item list-group-item-action">
                    <a href="/restaurant/{{$restaurant->id}}"><strong>{{$restaurant->name}}</strong></a> on {{$restaurant->created_at->format('n/j/y')}}
                </div>
            @endforeach


        </div>
        <div class="pagination mt-2">
            {{ $restaurants->links() }}
        </div>
    </div>
    @endif
</x-layout>
