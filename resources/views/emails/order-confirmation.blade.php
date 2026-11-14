<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation #{{ $order->order_number }} — BRX AGRO GLOBAL</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #2d3748; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f4f6f8; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" max-width="600" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #121820 0%, #1a232f 100%); padding: 32px 36px; text-align: center; border-bottom: 3px solid #78a22f;">
                            <div style="display: inline-block; background-color: #78a22f; color: #ffffff; font-weight: 800; font-size: 13px; letter-spacing: 2px; padding: 4px 12px; border-radius: 4px; text-transform: uppercase; margin-bottom: 12px;">
                                BRX AGRO GLOBAL
                            </div>
                            <h1 style="color: #ffffff; font-size: 22px; margin: 0 0 6px 0; font-weight: 700; letter-spacing: -0.5px;">
                                Commodity Order Confirmed
                            </h1>
                            <p style="color: #a0aec0; font-size: 13px; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
                                Order Reference: <strong style="color: #78a22f;">#{{ $order->order_number }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 36px 28px 36px;">
                            <p style="font-size: 16px; margin: 0 0 16px 0; color: #1a202c;">
                                Dear <strong>{{ $order->customer_name }}</strong>,
                            </p>
                            <p style="font-size: 14px; margin: 0 0 24px 0; color: #4a5568;">
                                Thank you for your order with <strong>BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA</strong>. Your commodity order <strong>#{{ $order->order_number }}</strong> has been recorded by our trade execution desk. Below is the summary of your registered lots.
                            </p>

                            <!-- Order Details Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #edf2f7; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <div style="font-size: 11px; font-weight: 700; color: #718096; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px;">
                                            Order Details & Logistics
                                        </div>
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="4" border="0" style="font-size: 13px;">
                                            <tr>
                                                <td width="35%" style="color: #718096; padding-bottom: 4px;">Order Date:</td>
                                                <td width="65%" style="color: #1a202c; font-weight: 600; padding-bottom: 4px;">{{ $order->created_at->format('M d, Y · H:i') }} UTC</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #718096; padding-bottom: 4px;">Terms / Shipping:</td>
                                                <td style="color: #1a202c; font-weight: 600; padding-bottom: 4px;">{{ $order->shipping_address ?? 'Santos / Paranaguá Port Export Dispatch' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #718096; padding-bottom: 4px;">Settlement Mode:</td>
                                                <td style="color: #1a202c; font-weight: 600; padding-bottom: 4px;">{{ $order->payment_method ?? 'CIF / FOB Destination Logistics' }}</td>
                                            </tr>
                                            @if($order->customer_phone)
                                            <tr>
                                                <td style="color: #718096; padding-bottom: 4px;">Buyer Phone:</td>
                                                <td style="color: #1a202c; padding-bottom: 4px;">{{ $order->customer_phone }}</td>
                                            </tr>
                                            @endif
                                            @if($order->notes)
                                            <tr>
                                                <td style="color: #718096; vertical-align: top;">Notes:</td>
                                                <td style="color: #4a5568; vertical-align: top;">{{ $order->notes }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Items Table -->
                            <div style="font-size: 12px; font-weight: 700; color: #1a202c; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                                Commodities & Sample Lots
                            </div>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="10" border="0" style="border: 1px solid #e2e8f0; border-radius: 6px; font-size: 13px; margin-bottom: 24px; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #f1f5f9; text-align: left; font-size: 12px; color: #475569; text-transform: uppercase;">
                                        <th style="padding: 10px; border-bottom: 1px solid #cbd5e1;">Item / Description</th>
                                        <th style="padding: 10px; border-bottom: 1px solid #cbd5e1; text-align: center;">Qty / Lots</th>
                                        <th style="padding: 10px; border-bottom: 1px solid #cbd5e1; text-align: right;">Contract Terms</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $item)
                                    <tr style="border-bottom: 1px solid #f1f5f9;">
                                        <td style="padding: 10px; font-weight: 600; color: #1e293b;">{{ $item->product_name }}</td>
                                        <td style="padding: 10px; text-align: center; color: #64748b;">{{ $item->quantity }}</td>
                                        <td style="padding: 10px; text-align: right; color: #16a34a; font-weight: 600;">Direct Wholesale RFQ (FOB / CIF)</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" style="padding: 12px; text-align: center; color: #94a3b8;">No items listed</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Instructions -->
                            <div style="background-color: #eaf7ef; border-left: 4px solid #16803c; padding: 14px 18px; border-radius: 4px; margin-bottom: 24px;">
                                <div style="font-weight: 700; color: #16803c; font-size: 13px; margin-bottom: 4px;">Next Execution Steps</div>
                                <div style="font-size: 13px; color: #2d3748;">
                                    Our trade finance department will verify export slot reservations, prepare the Commercial Invoice (CI) and Proforma Contract, and share the Bill of Lading (B/L) tracking protocol.
                                </div>
                            </div>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="center">
                                        <a href="https://brx-agro-global-importacao-e-export.vercel.app/#inbox" target="_blank" style="display: inline-block; background-color: #78a22f; color: #ffffff; text-decoration: none; font-weight: 700; font-size: 14px; padding: 12px 28px; border-radius: 6px; box-shadow: 0 2px 6px rgba(120, 162, 47, 0.3);">
                                            Track Order in Trade Desk Inbox
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #121820; padding: 24px 36px; text-align: center; border-top: 1px solid #2d3748; color: #a0aec0; font-size: 12px;">
                            <div style="font-weight: 700; color: #ffffff; margin-bottom: 4px;">
                                BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA
                            </div>
                            <div style="margin-bottom: 8px;">
                                CNPJ: 38.471.480/0001-41 · Av. Brig. Faria Lima, 3064, São Paulo - SP, Brasil
                            </div>
                            <div style="font-size: 11px; color: #a0aec0;">
                                WhatsApp: <a href="https://wa.me/5511958353433" style="color: #4ade80; text-decoration: none; font-weight: bold;">+55 11 95835-3433</a> · Email: <a href="mailto:brxagroglobal@gmail.com" style="color: #4ade80; text-decoration: none;">brxagroglobal@gmail.com</a>
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
