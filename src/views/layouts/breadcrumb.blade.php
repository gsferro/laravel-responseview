<ul class="breadcrumb">
    <li><a href="{{ route('home') }}"><i class="fa fa-home fa-fw"></i></a></li>
    @empty($breadcrumb)
        <li class="active">{{$titulo ?? "Página Principal"}}</li>
    @else
        @foreach ($breadcrumb as $key => $item)
            <li class="{{ isset($item["href"]) ? "" : "active" }}">
                @isset($item["href"])
                    <a href="{{$item["href"]}}">
                @endisset

                @isset($item["icone"])
                    <i class="{{ $item["icone"] }}"></i>
                @endisset

                {{ $item["titulo"] }}

                @isset($item["href"])
                    </a>
                @endisset
            </li>
        @endforeach
    @endempty
</ul>