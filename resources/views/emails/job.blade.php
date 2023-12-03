<!-- resources/views/emails/job_posted.blade.php -->

<p>Details of the newly created job:</p>
<p>Company Name: {{ $jobBank->company_name }}</p>
<p>Post: {{ $jobBank->post }}</p>
<p>Closing Date: {{ $jobBank->closing_date }}</p>
<p>Location: {{ $jobBank->location }}</p>
<p>Mobile Number: {{ $jobBank->mobile_number }}</p>
<!-- Add other job details as needed -->
