<form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Select Excel File:</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Import Students</button>
</form>
