<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Admin</title>
  <link rel="stylesheet" type="text/css" href="{{asset('css/checkbox.css')}}">
	  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
    <style type="text/css">

    </style>
</head>
<body>
<div class="wrap">
  <nav class="nav-bar navbar-inverse" role="navigation">
      <div id ="top-menu" class="container-fluid active">
          <a class="navbar-brand" href="#">Brand</a>
          <ul class="nav navbar-nav">        
              <form id="qform" class="navbar-form pull-left" role="search">
                 <input type="text" class="form-control" placeholder="Search" />                        
               </form>
              <li class="dropdown movable">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="fa fa-4x fa-child"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="#"><span class="fa fa-user"></span>My Profile</a></li>
                      <li><a href="#"><span class="fa fa-gear"></span>Settings</a></li>
                      <li class="divider"></li>
                      <li><a href="#"><span class="fa fa-power-off"></span>Logout</a></li>
                  </ul>
              </li>
              
          </ul>
      </div>      
  </nav>   
  @section('sidebar')
@show     
  
    <section class="content-inner">
     @yield('content')
    </section>
  </div>  
  
</div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>  
<script type="text/javascript">
$(function() {
   var accordionActive = false;
  
   $(window).on('resize', function() {
       var windowWidth = $(window).width();
       var $topMenu = $('#top-menu');
       var $sideMenu = $('#side-menu');     
       
       if (windowWidth < 768) {
          if ($topMenu.hasClass("active")) {             
            $topMenu.removeClass("active");
            $sideMenu.addClass("active");
            
            var $ddl = $('#top-menu .movable.dropdown');
            $ddl.detach();
            $ddl.removeClass('dropdown');
            $ddl.addClass('nav-header');
            
            $ddl.find('.dropdown-toggle').removeClass('dropdown-toggle').addClass('link');
            $ddl.find('.dropdown-menu').removeClass('dropdown-menu').addClass('submenu');
                        
            $ddl.prependTo($sideMenu.find('.accordion'));
            $('#top-menu #qform').detach().removeClass('navbar-form').prependTo($sideMenu);
            
            if (!accordionActive) {
               var Accordion2 = function(el, multiple) {
                 this.el = el || {};
                 this.multiple = multiple || false;

                  // Variables privadas
                 var links = this.el.find('.movable .link');
                 // Evento
                 links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
                }

              Accordion2.prototype.dropdown = function(e) {
                var $el = e.data.el;
                $this = $(this),
                  $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass('open');

                if (!e.data.multiple) {
                  $el.find('.movable .submenu').not($next).slideUp().parent().removeClass('open');
                };
              }    

              var accordion = new Accordion2($('ul.accordion'), false); 
              accordionActive = true;
            }
          }
       }
       else {
          if ($sideMenu.hasClass("active")) {              
            $sideMenu.removeClass('active');
            $topMenu.addClass('active');
            
            var $ddl = $('#side-menu .movable.nav-header');
            $ddl.detach();
            $ddl.removeClass('nav-header');
            $ddl.addClass('dropdown');
            
            $ddl.find('.link').removeClass('link').addClass('dropdown-toggle');
            $ddl.find('.submenu').removeClass('submenu').addClass('dropdown-menu');
            
             $('#side-menu #qform').detach().addClass('navbar-form').appendTo($topMenu.find('.nav'));
            $ddl.appendTo($topMenu.find('.nav'));
          }
       }
   });
  
  /**/
  var $menulink = $('.side-menu-link'),       
      $wrap = $('.wrap');
  
  $menulink.click(function() {    
    $menulink.toggleClass('active');
    $wrap.toggleClass('active');    
    return false;
  });
  
  /*Accordion*/
  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('.link');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
  }

  Accordion.prototype.dropdown = function(e) {
     var $el = e.data.el;
     $this = $(this),
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
    };
  } 

  var accordion = new Accordion($('ul.accordion'), false); 
  
  
});
</script>
@stack('scripts')
</body>
</html>