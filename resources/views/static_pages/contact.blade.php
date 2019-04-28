@extends('layouts.app')

@section('title', 'System Documentation')

@section('content')
	
<div class="page-wrapper">
        
    <!-- ******Header****** -->
    <header class="contact-header text-center">
        <div class="container">
            <div class="branding">
                <h1 class="logo">
                    <span class="text-highlight">Contact</span><span class="text-bold">Us</span>
                </h1>
            </div>
            <div class="tagline">
                <p>Our team is ready to hear from you</p>
            </div>           
        </div><!--//container-->
    </header><!--//header-->

    <div class="container-fluid">
        <div class="row justify-content-center content">
            <div class="col-md-4">
                <h3>Reach out to us!</h3>
                <p>Got a question or about this web app? Are you interested in partnering with us? Have some suggestions? Contact us:</p>
                {!! Form::open() !!}
                <div class="form-group">
                    {{Form::text('fname', '', ['class' => 'form-control', 'placeholder'=>'First Name'])}}
                </div>
                <div class="form-group">
                    {{Form::text('lname', '', ['class' => 'form-control', 'placeholder'=>'Last Name'])}}
                </div>
                <div class="form-group">
                    {{Form::email('email', '', ['class' => 'form-control', 'placeholder'=>'Email Address'])}}
                </div>
                <div class="form-group">
                    {{Form::text('pnumber', '', ['class' => 'form-control', 'placeholder'=>'Phone Number'])}}
                </div>
                <div class="form-group">
                    {{Form::textarea('message', '', ['class' => 'form-control', 'placeholder'=>'Message'])}}
                </div>
                    {{Form::submit('Submit',['class' => 'btn btn-primary', 'style'=> 'float:right;', 'disabled'])}}
                {!! Form::close() !!}
            </div>
            <div class="col-md-5 our-team">
                <h3>Meet Our Team</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit? Donec euismod, nibh cursus laoreet bibendum, leo leo viverra sem, vel venenatis sem dui ut nisl. Sed gravida tortor in justo congue, ac scelerisque leo scelerisque.</p>
                <ul>
                    <li><i class="fas fa-cat"></i><div class="dev-team-mem"><h6>George Price</h6><span>position in team</span><a href="tel:+0000000"><span>123-4567</span></a></div></li>
                    <li><i class="fas fa-crow"></i><div class="dev-team-mem"><h6>Allando Li</h6><span>position in team</span><a href="tel:+0000000"><span>890-1234</span></a></div></li>
                    <li><i class="fas fa-dog"></i><div class="dev-team-mem"><h6>Danay Chaveria</h6><span>position in team</span><a href="tel:+0000000"><span>567-8901</span></a></div></li>
                    <li><i class="fas fa-dove"></i><div class="dev-team-mem"><h6>Delroy Coc</h6><span>position in team</span><a href="tel:+0000000"><span>234-5678</span></a></div></li>
                    <li><i class="fas fa-dragon"></i><div class="dev-team-mem"><h6>Andrew Shal</h6><span>position in team</span><a href="tel:+0000000"><span>901-2345</span></a></div></li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection