{!!$body !!}
<p>Job Details:</p>

@foreach ($jobDetails as $job)
    <p>Company Name: {{ $job['company_name'] }}</p>
    <p>Post: {{ $job['post'] }}</p>
    <p>Closing Date: {{ $job['closing_date'] }}</p>
    <p>Location: {{ $job['location'] }}</p>
    <p>Mobile Number: {{ $job['mobile_number'] }}</p>
    <hr>
@endforeach