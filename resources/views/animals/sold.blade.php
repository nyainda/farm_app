<div class="container">
    <h1>Sold Animals</h1>

    @if($soldAnimals->isEmpty())
        <p>No animals have been sold.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Species</th>
                    <th>Sold Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soldAnimals as $animal)
                    <tr>
                        <td>{{ $animal->id }}</td>
                        <td>{{ $animal->name }}</td>
                        <td>{{ $animal->species }}</td>
                        <td>{{ $animal->updated_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
