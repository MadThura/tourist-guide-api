<h2>Review Removal Notice</h2>

<p>Hello {{ $review->user->name }},</p>

<p>
    We wanted to let you know that your review for
    <strong>{{ $review->place->name }}</strong> has been removed by our moderation team
    because it did not follow our community guidelines.
</p>

<p>
    If you believe this was a mistake, feel free to contact support.
</p>

<p>Thanks,<br>
    {{ config('app.name') }} Team
</p>