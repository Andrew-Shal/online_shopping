<div class="row profile-details">
    <ul>
        <li><span>first name:</span>{{$user->first_name}}</li>
        <li><span>last name: </span>{{$user->last_name}}</li>
        <li><span>email: </span>{{$user->email}}</li>
        <li><span>country: </span>{{$user->cust_country}}</li>
        <li><span>street: </span>{{$user->cust_street}}</li>
        <li><span>phone number: </span>{{$user->phone_number}}</li>
        <li><span>encrypted password: </span>{{auth()->user()->getAuthPassword()}}</li>
    </ul>
</div>

<style>
.profile-details ul{
    list-style:none;
}

.profile-details ul li{
    padding-bottom:10px;
}

.profile-details span{
    font-size:1.1em;
    font-weight:bold;
    padding-right:3px;
}
</style>
