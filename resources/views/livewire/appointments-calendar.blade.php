<div>
    <livewire-calendar
        :events="$events"
        theme="standard"
        initial-date="{{ $gridStartsAt->format('Y-m-d') }}"
    />
</div>
