<!DOCTYPE html>
<html>
@include('shared._head')
<body>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '294741254272485',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

@include('shared._navbar')

@yield('content')

@include('shared._footer')

@include('shared._javascript')

</body>
</html>