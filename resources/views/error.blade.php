
@if(count($errors) > 0)
<div class="w3-panel w3-red">
<ul>
    @foreach($errors -> all() as $error)
    <li>
        {!! $error !!}
    </li>
    @endforeach
</ul>
</div>
@endif 

