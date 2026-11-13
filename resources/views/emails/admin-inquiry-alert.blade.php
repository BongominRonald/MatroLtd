<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Trade Inquiry Alert</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #2d3748; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f4f6f8; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" max-width="600" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <tr>
                        <td style="background: #121820; padding: 28px 36px; border-bottom: 3px solid #78a22f;">
                            <div style="font-size: 11px; font-weight: 800; color: #78a22f; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 6px;">
                                BRX AGRO GLOBAL — TRADE ALERT
                            </div>
                            <h2 style="color: #ffffff; font-size: 20px; margin: 0; font-weight: 700;">
                                New Inbound Trade Inquiry
                            </h2>
                            <p style="color: #a0aec0; font-size: 13px; margin: 6px 0 0 0;">
                                Ref: <strong>{{ $reference }}</strong> · Received {{ now()->toFormattedDateString() }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 32px 36px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="6" border="0" style="font-size: 14px; background-color: #f8fafc; border-radius: 8px; border: 1px solid #edf2f7; margin-bottom: 24px;">
                                <tr>
                                    <td width="30%" style="color: #718096; font-weight: 600;">Contact Name:</td>
                                    <td width="70%" style="color: #1a202c; font-weight: 700;">{{ $inquiry->name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Email:</td>
                                    <td style="color: #1a202c;"><a href="mailto:{{ $inquiry->email }}" style="color: #2563eb; text-decoration: none;">{{ $inquiry->email }}</a></td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Phone / WhatsApp:</td>
                                    <td style="color: #1a202c;">{{ $inquiry->phone ?? 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Role:</td>
                                    <td style="color: #1a202c; text-transform: capitalize;">{{ $inquiry->role }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Subject / Target:</td>
                                    <td style="color: #1a202c; font-weight: 600;">{{ $inquiry->subject }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600; vertical-align: top;">Message:</td>
                                    <td style="color: #2d3748; vertical-align: top; white-space: pre-line;">{{ $inquiry->message }}</td>
                                </tr>
                            </table>

                            <div style="text-align: center; margin-top: 10px;">
                                <a href="mailto:{{ $inquiry->email }}?subject=RE: {{ urlencode('BRX Agro Global Inquiry ' . $reference . ' — ' . $inquiry->subject) }}" style="display: inline-block; background-color: #121820; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 13px; padding: 10px 22px; border-radius: 6px; margin-right: 8px;">
                                    Reply via Email
                                </a>
                                @if($inquiry->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" style="display: inline-block; background-color: #78a22f; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 13px; padding: 10px 22px; border-radius: 6px;">
                                    Chat on WhatsApp
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #edf2f7; padding: 16px 36px; text-align: center; color: #718096; font-size: 11px;">
                            Automated notification dispatched from BRX AGRO GLOBAL CRM.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
