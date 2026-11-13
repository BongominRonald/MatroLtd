<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Confirmation — BRX AGRO GLOBAL</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #2d3748; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f4f6f8; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" max-width="600" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #121820 0%, #1a232f 100%); padding: 32px 36px; text-align: center; border-bottom: 3px solid #78a22f;">
                            <div style="display: inline-block; background-color: #78a22f; color: #ffffff; font-weight: 800; font-size: 14px; letter-spacing: 2px; padding: 4px 12px; border-radius: 4px; text-transform: uppercase; margin-bottom: 12px;">
                                BRX AGRO GLOBAL
                            </div>
                            <h1 style="color: #ffffff; font-size: 22px; margin: 0 0 6px 0; font-weight: 700; letter-spacing: -0.5px;">
                                Trade Inquiry Received
                            </h1>
                            <p style="color: #a0aec0; font-size: 13px; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
                                Reference: <strong style="color: #78a22f;">{{ $reference }}</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 36px 28px 36px;">
                            <p style="font-size: 16px; margin: 0 0 16px 0; color: #1a202c;">
                                Dear <strong>{{ $inquiry->name }}</strong>,
                            </p>
                            <p style="font-size: 14px; margin: 0 0 20px 0; color: #4a5568;">
                                Thank you for contacting <strong>BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA</strong>. We have successfully logged your commercial trade inquiry. Our international export desk in São Paulo has received your specification and is preparing the relevant FOB/CIF logistics and laboratory analysis sheets.
                            </p>

                            <!-- Summary Card -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #edf2f7; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <div style="font-size: 11px; font-weight: 700; color: #718096; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px;">
                                            Inquiry Summary
                                        </div>
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="4" border="0" style="font-size: 13px;">
                                            <tr>
                                                <td width="35%" style="color: #718096; padding-bottom: 6px;">Reference Code:</td>
                                                <td width="65%" style="color: #1a202c; font-weight: 600; padding-bottom: 6px;">{{ $reference }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #718096; padding-bottom: 6px;">Subject / Commodity:</td>
                                                <td style="color: #1a202c; font-weight: 600; padding-bottom: 6px;">{{ $inquiry->subject }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #718096; padding-bottom: 6px;">Role / Capacity:</td>
                                                <td style="color: #1a202c; font-weight: 600; padding-bottom: 6px; text-transform: capitalize;">{{ $inquiry->role }}</td>
                                            </tr>
                                            @if($inquiry->phone)
                                            <tr>
                                                <td style="color: #718096; padding-bottom: 6px;">Contact Phone:</td>
                                                <td style="color: #1a202c; padding-bottom: 6px;">{{ $inquiry->phone }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td style="color: #718096; vertical-align: top;">Requirement / Note:</td>
                                                <td style="color: #4a5568; vertical-align: top; white-space: pre-line;">{{ $inquiry->message }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Next Steps -->
                            <div style="background-color: #eaf7ef; border-left: 4px solid #16803c; padding: 14px 18px; border-radius: 4px; margin-bottom: 24px;">
                                <div style="font-weight: 700; color: #16803c; font-size: 13px; margin-bottom: 4px;">What Happens Next?</div>
                                <div style="font-size: 13px; color: #2d3748;">
                                    A trade desk executive will reach out within 4–24 hours via email or WhatsApp with official specifications (SGS/FOSFA standards), current export availability from Brazilian ports, and tailored pricing.
                                </div>
                            </div>

                            <p style="font-size: 13px; color: #718096; margin: 0 0 24px 0;">
                                For immediate assistance or urgent contracts, you can connect directly with our trading desk via WhatsApp or phone.
                            </p>

                            <!-- Direct WhatsApp Action Button -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="center">
                                        <a href="https://wa.me/5511952987545?text=Hello%20BRX%20Agro%20Global%2C%20I%20have%20submitted%20inquiry%20{{ urlencode($reference) }}%20and%20would%20like%20to%20follow%20up." target="_blank" style="display: inline-block; background-color: #78a22f; color: #ffffff; text-decoration: none; font-weight: 700; font-size: 14px; padding: 12px 28px; border-radius: 6px; box-shadow: 0 2px 6px rgba(120, 162, 47, 0.3);">
                                            Contact Trade Desk on WhatsApp
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
                                CNPJ: 49.882.204/0001-99 · Av. Brigadeiro Faria Lima, 1461, 4º andar, São Paulo - SP, Brasil
                            </div>
                            <div style="font-size: 11px; color: #718096;">
                                WhatsApp / Phone: +55 (11) 95298-7545 · Email: info@matogrossoexportltda.com.br
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
