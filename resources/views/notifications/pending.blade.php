@extends('layouts.app')


    <div class="container">
        <body>
            <h1>Notifications</h1>
            <ul>
                @forelse ($notifications as $notification)
                    <li>{{ $notification->data['message'] }}</li>
                @empty
                    <li>No notifications</li>
                @endforelse
            </ul>
        </body>
    </div>

