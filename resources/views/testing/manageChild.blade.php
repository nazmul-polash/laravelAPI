@php
    use App\Http\Controllers\UserController;
@endphp

<ul>
    @foreach ($childs as $child)
        @php
            $treeView = UserController::userTreeView($child->id);
        @endphp



        <li><span>
                @if ($treeView > 0)
                    <i class="fa fa-minus-square"></i>
                @endif{{ $child->firstname }} {{ $child->lastname }}
            </span>
            @if (count((array) $child->childs))
                @include('manageChild', ['childs' => $child->childs])
            @endif
        </li>
    @endforeach

</ul>
