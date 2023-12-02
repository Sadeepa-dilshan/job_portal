<x-mail::message>
# Introduction

Congratulation! You are not a premium User
<p>Your purchase details:</p>
<p>Plan: {{$plan}}</p>
<p>Your plan ends on: {{$billingEnds}}:</p>
<x-mail::button :url="''">
Post a Job
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
