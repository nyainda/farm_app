<div class="container">
    <h1>Imported Animals</h1>
    @if(isset($importedAnimals) && $importedAnimals->isNotEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Species</th>
                    <!-- Add other columns as necessary -->
                </tr>
            </thead>
            <tbody>
                @foreach($importedAnimals as $animal)
                    <tr>
                        <td>{{ $animal->id }}</td>
                        <td>{{ $animal->name }}</td>
                        <td>{{ $animal->species }}</td>
                        <!-- Add other columns as necessary -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No animals were imported.</p>
    @endif
</div>
