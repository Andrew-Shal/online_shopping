<div class="row billing-details">
    <ul>
        <li><span>Email:</span>{{$billingInfo->billing_email}}</li>
        <li><span>Full Name: </span>{{$billingInfo->billing_name}}</li>
        <li><span>Phone Number: </span>{{$billingInfo->billing_phone}}</li>
        <li><span>Country: </span>{{$billingInfo->billing_province}}</li>
        <li><span>Address: </span>{{$billingInfo->billing_address}}</li>
        <li><span>City: </span>{{$billingInfo->billing_city}}</li>
    </ul>
</div>

<style>
.billing-details ul{
    list-style:none;
}

.billing-details ul li{
    padding-bottom:10px;
}

.billing-details span{
    font-size:1.1em;
    font-weight:bold;
    padding-right:3px;
}
</style>