<nav id="mobile-nav">
    <div>
        <ul>
            @foreach($global_cats as $index => $cat)
                <li>
                    <a href="/category/{{$cat->slug}}">{{$cat->title}}</a>
                    <ul>
                        @foreach($cat->sub_categories as $sub_cat)
                            <li><a href="/category/{{$cat->slug}}/{{$sub_cat->slug}}">{{$sub_cat->title}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</nav>