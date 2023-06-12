<x-layout>

    <div class="container py-md-5 container--narrow">
        <h2>
            {{$username}}
            <form class="ml-2 d-inline" action="#" method="POST">
                <a href="/restaurant"><div class="btn btn-primary btn-sm">Add Restaurant &nbsp; <i class="fa fa-light fa-plus"></i></div></a>
                <!-- <button class="btn btn-danger btn-sm">Stop Following <i class="fas fa-user-times"></i></button> -->
            </form>
        </h2>

        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <div class="profile-nav-link nav-item full-border nav-link active">Restaurants Added: {{$count}}</div>

        </div>

        <div class="list-group">
            @foreach($restaurants as $restaurant)
                <div class="list-group-item list-group-item-action">
                    <a href="/restaurant/{{$restaurant->id}}"><strong>{{$restaurant->name}}</strong></a> on {{$restaurant->created_at->format('n/j/y')}}
                </div>
            @endforeach


        </div>
    </div>


</x-layout>
