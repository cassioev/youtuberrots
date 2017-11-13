
  <script>





  
 function oauth2SignIn() {

     var YOUR_CLIENT_ID = '783258645866-b3caj961rqa1mgjgjta6o4c9krbsodad.apps.googleusercontent.com';
     var YOUR_REDIRECT_URI = 'http://localhost/youtuberoots/';
     //var YOUR_REDIRECT_URI = 'https://youtuberoots.000webhostapp.com/youtuberoots';
     

    // Google's OAuth 2.0 endpoint for requesting an access token
    var oauth2Endpoint = 'https://accounts.google.com/o/oauth2/v2/auth';

    // Create element to open OAuth 2.0 endpoint in new window.
    var form = document.createElement('form');
    form.setAttribute('method', 'GET'); // Send as a GET request.
    form.setAttribute('action', oauth2Endpoint);

    // Parameters to pass to OAuth 2.0 endpoint.
    var params = {'client_id': YOUR_CLIENT_ID,
                  'redirect_uri': YOUR_REDIRECT_URI,
                  'scope': 'https://www.googleapis.com/auth/youtube.force-ssl https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
                   'include_granted_scopes': 'true',
                    'access_type': 'offline',
                  'response_type': 'code'};

    // Add form parameters as hidden input values.
    for (var p in params) {
      var input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', p);
      input.setAttribute('value', params[p]);
      form.appendChild(input);
    }

    // Add form to page and submit it to open the OAuth 2.0 endpoint.
    document.body.appendChild(form);
    form.submit();

  }



 
</script>


<button  onclick="oauth2SignIn()" >Click me</button>


<div id="auth-status" style="display: inline; padding-left: 25px"></div><hr>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script async defer src="https://apis.google.com/js/api.js" 
        onload="this.onload=function(){}" 
        onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>