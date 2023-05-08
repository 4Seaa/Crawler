<form id="crawl-form" action="/" method="GET">
    @csrf
    <label for="inputField">URL:</label>
    <input class="form-control" type="text" id="inputField" name="url" value="{{ $url }}" required>
<div id="submit-btn-container">
    <button class="btn btn-primary" id="submit-btn" type="submit">Crawl</button>
</div>
</form>
