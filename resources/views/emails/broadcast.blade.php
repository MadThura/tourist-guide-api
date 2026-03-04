<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $appName }}</title>
</head>

<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;color:#111827;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f3f4f6;padding:24px 0;">
        <tr>
            <td align="center" style="padding:0 12px;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0"
                    style="max-width:600px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7eb;">

                    <!-- Header -->
                    <tr>
                        <td style="padding:22px 24px;background:#111827;">
                            <div style="font-size:14px;color:#d1d5db;margin-bottom:6px;">
                                {{ $appName }}
                            </div>
                            <div style="font-size:20px;font-weight:700;color:#ffffff;line-height:1.2;">
                                {{ $subject }}
                            </div>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:22px 24px;">
                            @if(!empty($content))
                            <div style="font-size:14px;color:#374151;line-height:1.7;white-space:pre-line;">
                                {{ $content }}
                            </div>
                            @endif

                            <!-- Button -->
                            @if(!empty($buttonText) && !empty($buttonUrl))
                            <div style="padding-top:20px;text-align:center;">
                                <a href="{{ $buttonUrl }}"
                                    style="display:inline-block;background:#2563eb;color:#ffffff;
                                              padding:12px 18px;border-radius:8px;text-decoration:none;
                                              font-size:14px;font-weight:700;">
                                    {{ $buttonText }}
                                </a>
                            </div>
                            @endif

                            <!-- Divider -->
                            <div style="margin:24px 0;border-top:1px solid #e5e7eb;"></div>

                            <!-- Small Help Text -->
                            @if(!empty($secondaryText))
                            <div style="font-size:12px;color:#6b7280;line-height:1.6;white-space:pre-line;">
                                {{ $secondaryText }}
                            </div>
                            @else
                            <div style="font-size:12px;color:#6b7280;line-height:1.6;">
                                If you have any questions, just reply to this email—we’re happy to help.
                            </div>
                            @endif

                            <!-- Fallback URL -->
                            @if(!empty($buttonText) && !empty($buttonUrl))
                            <div style="margin-top:12px;font-size:12px;color:#6b7280;line-height:1.6;">
                                If the button doesn’t work, copy and paste this link into your browser:<br>
                                <span style="word-break:break-all;color:#2563eb;">{{ $buttonUrl }}</span>
                            </div>
                            @endif
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:18px 24px;background:#f9fafb;font-size:12px;color:#6b7280;">
                            © {{ now()->year }} {{ $appName }}. All rights reserved.
                        </td>
                    </tr>

                </table>

                <!-- Outer spacing note -->
                <div style="max-width:600px;width:100%;padding:12px 0 0;text-align:center;font-size:11px;color:#9ca3af;">
                    Please do not share sensitive information via email.
                </div>
            </td>
        </tr>
    </table>
</body>

</html>