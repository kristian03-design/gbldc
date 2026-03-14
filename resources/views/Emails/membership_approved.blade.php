<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to GBLDC Cooperative</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f7fb;
            padding: 20px 0;
        }
        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 640px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        }
        .header {
            padding: 20px 28px 12px;
            background: linear-gradient(135deg, #1e8449 0%, #27ae60 100%);
            color: #ffffff;
        }
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .logo {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            overflow: hidden;
            background: #ffffff;
            padding: 4px;
        }
        .logo img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .coop-name {
            font-size: 15px;
            font-weight: 600;
            line-height: 1.3;
        }
        .coop-sub {
            font-size: 11px;
            opacity: 0.8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .body {
            padding: 26px 28px 22px;
            color: #1f2933;
            font-size: 14px;
            line-height: 1.6;
        }
        .tagline {
            font-size: 13px;
            color: #4b5563;
            margin-bottom: 14px;
        }
        .highlight {
            font-weight: 600;
            color: #1e8449;
        }
        .panel {
            margin: 18px 0;
            padding: 14px 16px;
            border-radius: 10px;
            background-color: #f1faf4;
            border: 1px solid #d4f3dc;
        }
        .panel-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #6b7280;
            margin-bottom: 6px;
        }
        .credentials-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .credentials-table th,
        .credentials-table td {
            text-align: left;
            padding: 6px 0;
        }
        .credentials-table th {
            width: 36%;
            font-weight: 500;
            color: #6b7280;
        }
        .credentials-table td {
            font-weight: 600;
            color: #111827;
        }
        .note {
            margin-top: 14px;
            font-size: 12px;
            color: #6b7280;
        }
        .note strong {
            color: #111827;
        }
        .footer {
            padding: 14px 28px 22px;
            font-size: 11px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }
        a.button {
            display: inline-block;
            margin-top: 14px;
            padding: 9px 18px;
            border-radius: 999px;
            background: linear-gradient(135deg, #27ae60 0%, #1e8449 100%);
            color: #ffffff !important;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
  <div class="wrapper">
    <table class="main" role="presentation" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td class="header">
          <div class="logo-wrap">
            <div class="logo">
              <img src="{{ asset('images/logocoop-removebg-preview-2.png') }}" alt="GBLDC Logo">
            </div>
            <div>
              <div class="coop-name">Greater Bulacan Livelihood Development Cooperative</div>
              <div class="coop-sub">Membership Approved</div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td class="body">
          <p>Dear <span class="highlight">{{ $memberName }}</span>,</p>

          <p>Welcome to the <strong>Greater Bulacan Livelihood Development Cooperative (GBLDC)</strong>! Your membership application has been <span class="highlight">approved</span>.</p>

          <p class="tagline">
            You may now sign in to the GBLDC Member Portal using the login details below:
          </p>

          <div class="panel">
            <div class="panel-title">Membership &amp; Login Details</div>
            <table class="credentials-table">
              <tr>
                <th>Membership Number</th>
                <td>{{ $memberNumber }}</td>
              </tr>
              <tr>
                <th>Registered Email</th>
                <td>{{ $email }}</td>
              </tr>
              <tr>
                <th>Portal Username</th>
                <td>{{ $username }}</td>
              </tr>
              <tr>
                <th>Temporary Password</th>
                <td>{{ $password }}</td>
              </tr>
            </table>

            <p class="note">
              <strong>Security reminder:</strong> For your protection, please log in as soon as possible and
              change your password from the account settings page. Do not share your credentials with anyone.
            </p>

            <a href="{{ route('Member.Login') }}" class="button" target="_blank" rel="noopener">
              Go to Member Login
            </a>
          </div>

          <p>If you did not request this membership or believe this email was sent to you in error, please contact our office immediately.</p>

          <p>Thank you for trusting GBLDC. We look forward to serving you.</p>

          <p>Warm regards,<br>
             <strong>GBLDC Membership Team</strong></p>
        </td>
      </tr>
      <tr>
        <td class="footer">
          © {{ date('Y') }} Greater Bulacan Livelihood Development Cooperative. All rights reserved.
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
