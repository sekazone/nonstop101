<html xmlns="http://www.w3.org/1999/xhtml"
  xmlns:fb="https://www.facebook.com/2008/fbml">
  <head>
    <title>Request Example</title>
  </head>

  <body>
    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
<div class="container">
<div class="sidebar">
<form action="">
<select name="places">
<option value="all">All</option>
<option value="shop">Shops</option>
<option value="bars">Bars & Pubs</option>
<option value="pharmacy">Pharmacy</option>
</select>
<input type="button"
        onclick="sendRequestToRecipients(); return false;"
        value="Send Request to Users Directly"
      />
      <input type="text" value="User ID" name="user_ids" />
      </p>
    <p>
    <input type="button"
      onclick="sendRequestViaMultiFriendSelector(); return false;"
      value="Send Request to Many Users with MFS"
    />
</form>
</div>
<div class="map" id="map"></div>
</div>
<script>
      FB.init({
        appId  : 'YOUR_APP_ID',
        frictionlessRequests: true
      });

      function sendRequestToRecipients() {
        var user_ids = document.getElementsByName("user_ids")[0].value;
        FB.ui({method: 'apprequests',
          message: 'My Great Request',
          to: user_ids
        }, requestCallback);
      }

      function sendRequestViaMultiFriendSelector() {
        FB.ui({method: 'apprequests',
          message: 'My Great Request'
        }, requestCallback);
      }
      
      function requestCallback(response) {
        // Handle callback here
      }
    </script>
</body>
</html>
