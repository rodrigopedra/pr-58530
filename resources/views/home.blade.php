<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="5">

    <title>PR 58530</title>

    <style>
        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid black;
        }
    </style>
</head>
<body>

@session('message')
<p>{{ $value }}</p>
@endsession

<form action="/" method="POST">
    @csrf
    <fieldset>
        <legend>Send a message</legend>
        <input type="text" name="message" value="{{ now()->toDateTimeString() }}" required>
        <button type="submit">send notification</button>
    </fieldset>
</form>

<hr>

<table>
    <caption>Table is updated by the queue, so be sure queue is running and wait until the page refreshes</caption>

    <thead>
    <tr>
        <th>#</th>
        <th>type</th>
        <th>data</th>
    </tr>
    </thead>
    <tbody>
    @forelse($notifications as $notification)
        <tr>
            <th scope="row">{{ $notification->id }}</th>
            <td>{{ $notification->type }}</td>
            <td>@json($notification->data)</td>
        </tr>
    @empty
        <tr>
            <td colspan="3"><em>no notifications</em></td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
