<x-mail::message>
    <p><strong>Name:</strong> {{ $formData['name'] }}</p>
    <p><strong>Email:</strong> {{ $formData['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $formData['message'] }}</p>
    <a href="{{ route('admin.reply', $id) }}">Reply</a>
</x-mail::message>