<strong>First Name:</strong> {{ $user->first_name }}<br>
<strong>Last Name:</strong> {{ $user->last_name }}<br>
<strong>Email:</strong> {{ $user->email }}<br>
<strong>Client ID:</strong> {{ $user->id  }}<br>
<strong>License Key:</strong> {{ $user->license->license_key }}<br>
<strong>Validity:</strong> {{ $user->license->expire_date }}<br>
<br>
<br>