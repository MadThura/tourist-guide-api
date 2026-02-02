<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $appName }}</title>
</head>

<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:24px;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:8px;padding:24px;">

                    <!-- Header -->
                    <tr>
                        <td style="font-size:20px;font-weight:bold;color:#111827;padding-bottom:12px;">
                            {{ $appName }}
                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td style="font-size:14px;color:#374151;white-space:pre-line;line-height:1.6;">
                            {{ $content }}
                        </td>
                    </tr>

                    <!-- Button -->
                    @if(!empty($buttonText) && !empty($buttonUrl))
                    <tr>
                        <td align="center" style="padding-top:24px;">
                            <a href="{{ $buttonUrl }}"
                                style="background:#2563eb;color:#ffffff;
                                      padding:12px 20px;border-radius:6px;
                                      text-decoration:none;font-size:14px;">
                                {{ $buttonText }}
                            </a>
                        </td>
                    </tr>
                    @endif

                    <!-- Footer -->
                    <tr>
                        <td style="padding-top:32px;font-size:12px;color:#6b7280;">
                            © {{ now()->year }} {{ $appName }}. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>