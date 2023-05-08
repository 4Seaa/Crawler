<form id="crawl-form" action="/" method="GET">
    @csrf
    <label for="inputField">URL:</label>
    <input class="form-control" type="text" id="inputField" name="url" value="{{ $url }}" required>
<div class="form-check">
  <input class="form-check-input" type="radio" name="file_extension" value="jpg" id="file_extension2" checked>
  <label class="form-check-label" for="file_extension2">
    jpg
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="file_extension" value="png" id="file_extension1">
  <label class="form-check-label" for="file_extension1">
    png
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="file_extension" value="gif" id="file_extension1">
  <label class="form-check-label" for="file_extension1">
    gif
  </label>
</div>
<div id="submit-btn-container">
    <button class="btn btn-primary" id="submit-btn" type="submit">Crawl</button>
</div>
</form>
