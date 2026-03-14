<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Status Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-container {
            background-color: #f9f9f9;
            border-radius: 10px;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            background-color: #ffffff;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .status-approved {
            background-color: #dcfce7;
            color: #16a34a;
            border: 2px solid #16a34a;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #dc2626;
            border: 2px solid #dc2626;
        }
        .loan-details {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #6b7280;
        }
        .value {
            font-weight: 700;
            color: #1f2937;
        }
        .amount {
            font-size: 24px;
            color: #16a34a;
            font-weight: bold;
        }
        .payment-schedule {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #9ca3af;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background-color: #16a34a;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>📋 Loan Application Update</h1>
        </div>
        
        <div class="content">
            <p>Dear <strong>{{ $memberName }}</strong>,</p>
            
            <p>{{ $statusMessage }}</p>
            
            <div style="text-align: center;">
                @if($status === 'approved')
                <span class="status-badge status-approved">✓ Approved</span>
                @elseif($status === 'rejected')
                <span class="status-badge status-rejected">✗ Rejected</span>
                @endif
            </div>
            
            <div class="loan-details">
                <div class="detail-row">
                    <span class="label">Loan Number:</span>
                    <span class="value">{{ $loanNumber }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Loan Amount:</span>
                    <span class="value amount">₱{{ number_format($loanAmount, 2) }}</span>
                </div>
                @if($status === 'approved' && $dueAmount !== null)
                <div class="detail-row">
                    <span class="label">Due Amount:</span>
                    <span class="value">₱{{ number_format($dueAmount, 2) }}</span>
                </div>
                @endif
            </div>
            
            @if($status === 'approved' && $paymentStartDate !== null)
            <div class="payment-schedule">
                <strong>📅 Payment Schedule:</strong>
                <br><br>
                <div class="detail-row">
                    <span class="label">Payment Start Date:</span>
                    <span class="value">{{ $paymentStartDate }}</span>
                </div>
                @if($frequencyOfPayment !== null)
                <div class="detail-row">
                    <span class="label">Frequency:</span>
                    <span class="value">{{ $frequencyOfPayment }}</span>
                </div>
                @endif
            </div>
            @endif
            
            <p style="margin-top: 25px;">
                Thank you for choosing <strong>GBLDC Cooperative</strong> for your financial needs.
            </p>
            
            <p>If you have any questions or concerns about your loan, please don't hesitate to contact us.</p>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('Member.Login') }}" class="button">View Your Account</a>
            </div>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} GBLDC Cooperative. All rights reserved.</p>
            <p>This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
