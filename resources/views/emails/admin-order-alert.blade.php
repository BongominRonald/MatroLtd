<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Alert #{{ $order->order_number }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #2d3748; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f4f6f8; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" max-width="600" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <tr>
                        <td style="background: #121820; padding: 28px 36px; border-bottom: 3px solid #78a22f;">
                            <div style="font-size: 11px; font-weight: 800; color: #78a22f; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 6px;">
                                BRX AGRO GLOBAL — ORDER ALERT
                            </div>
                            <h2 style="color: #ffffff; font-size: 20px; margin: 0; font-weight: 700;">
                                New Commodity Order Placed #{{ $order->order_number }}
                            </h2>
                            <p style="color: #a0aec0; font-size: 13px; margin: 6px 0 0 0;">
                                Placed by <strong>{{ $order->customer_name }}</strong> · Total: ${{ number_format($order->total_amount, 2) }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 32px 36px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="6" border="0" style="font-size: 14px; background-color: #f8fafc; border-radius: 8px; border: 1px solid #edf2f7; margin-bottom: 24px;">
                                <tr>
                                    <td width="30%" style="color: #718096; font-weight: 600;">Customer:</td>
                                    <td width="70%" style="color: #1a202c; font-weight: 700;">{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Email:</td>
                                    <td style="color: #1a202c;"><a href="mailto:{{ $order->customer_email }}" style="color: #2563eb; text-decoration: none;">{{ $order->customer_email }}</a></td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Phone:</td>
                                    <td style="color: #1a202c;">{{ $order->customer_phone ?? 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Shipping / Port:</td>
                                    <td style="color: #1a202c;">{{ $order->shipping_address }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #718096; font-weight: 600;">Payment Terms:</td>
                                    <td style="color: #1a202c;">{{ $order->payment_method }}</td>
                                </tr>
                                @if($order->notes)
                                <tr>
                                    <td style="color: #718096; font-weight: 600; vertical-align: top;">Notes:</td>
                                    <td style="color: #2d3748; vertical-align: top;">{{ $order->notes }}</td>
                                </tr>
                                @endif
                            </table>

                            <div style="font-size: 12px; font-weight: 700; color: #1a202c; text-transform: uppercase; margin-bottom: 8px;">Order Line Items</div>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="8" border="0" style="border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; margin-bottom: 24px; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #f1f5f9; text-align: left; font-size: 11px; color: #475569; text-transform: uppercase;">
                                        <th style="padding: 8px; border-bottom: 1px solid #cbd5e1;">Commodity</th>
                                        <th style="padding: 8px; border-bottom: 1px solid #cbd5e1; text-align: center;">Qty</th>
                                        <th style="padding: 8px; border-bottom: 1px solid #cbd5e1; text-align: right;">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr style="border-bottom: 1px solid #f1f5f9;">
                                        <td style="padding: 8px; font-weight: 600;">{{ $item->product_name }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $item->quantity }}</td>
                                        <td style="padding: 8px; text-align: right;">${{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="text-align: center; margin-top: 10px;">
                                <a href="mailto:{{ $order->customer_email }}?subject=RE: {{ urlencode('BRX Agro Global Order #' . $order->order_number) }}" style="display: inline-block; background-color: #121820; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 13px; padding: 10px 22px; border-radius: 6px; margin-right: 8px;">
                                    Contact Customer
                                </a>
                                @if($order->customer_phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" style="display: inline-block; background-color: #78a22f; color: #ffffff; text-decoration: none; font-weight: 600; font-size: 13px; padding: 10px 22px; border-radius: 6px;">
                                    WhatsApp Buyer
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #edf2f7; padding: 16px 36px; text-align: center; color: #718096; font-size: 11px;">
                            Automated dispatch from BRX AGRO GLOBAL Order Execution System.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
