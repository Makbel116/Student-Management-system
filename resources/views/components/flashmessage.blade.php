@if (session()->has('message'))
<div  x-data="{ show:true }" x-init="setTimeout(()=>show=false,2000)" x-show="show" class="bg-success text-center text-white py-3 fixed-bottom ">
    <p>
        {{session("message")}}
    </p>
</div>

@endif


@if (session()->has('error'))
<div  x-data="{ show:true }" x-init="setTimeout(()=>show=false,2000)" x-show="show" class="bg-danger text-center text-white py-3 fixed-bottom ">
    <p>
        {{session("error")}}
    </p>
</div>

@endif