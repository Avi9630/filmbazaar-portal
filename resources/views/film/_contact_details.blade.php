<table class="table">
    <tr>
        <td colspan="2"><strong>Contact {{ $key+1 }}:</strong></td>
   
    </tr>
    <tr>
        <td><strong>Designation:</strong></td>
        <td>{{ $contact->designation ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Other Designation:</strong></td>
        <td>{{ $contact->designation_other ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Roles:</strong></td>
        <td>{{ $contact->roles ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Name:</strong></td>
        <td>{{ $contact->first_name ?? '' }} {{ $contact->last_name ?? '' }}</td>
    </tr>
    <tr>
        <td><strong>Email:</strong></td>
        <td>{{ $contact->email ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Company:</strong></td>
        <td>{{ $contact->company ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Phone:</strong></td>
        <td>{{ $contact->phone ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>City:</strong></td>
        <td>{{ $contact->city ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>State:</strong></td>
        <td>{{ $contact->state ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Country:</strong></td>
        <td>{{ $contact->countryRelation->name ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Address:</strong></td>
        <td>{{ $contact->address ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Website:</strong></td>
        <td><a href="{{ $contact->website }}" target="_blank">{{ $contact->website ?? 'N/A' }}</a></td>
    </tr>
    <tr>
        <td><strong>Facebook:</strong></td>
        <td><a href="{{ $contact->facebook }}" target="_blank">{{ $contact->facebook ?? 'N/A' }}</a></td>
    </tr>
    <tr>
        <td><strong>Twitter:</strong></td>
        <td><a href="{{ $contact->twitter }}" target="_blank">{{ $contact->twitter ?? 'N/A' }}</a></td>
    </tr>
    <tr>
        <td><strong>Instagram:</strong></td>
        <td><a href="{{ $contact->instagram }}" target="_blank">{{ $contact->instagram ?? 'N/A' }}</a></td>
    </tr>
    <tr>
        <td><strong>Biography:</strong></td>
        <td>{{ $contact->biography ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>Profile Picture:</strong></td>
        <td>
            @if(!empty($contact->profileDoc->url))
                <img src="https://wavesbazaar.com/api/project/file/read/{{ $contact->profileDoc->url }}" alt="Profile Image" width="100">
            @else
                N/A
            @endif
        </td>
    </tr>
</table>
