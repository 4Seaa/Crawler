<form id="crawl-form" action="/" method="GET">
    @csrf
    <label for="inputField">URL:</label>
    <input class="form-control" type="text" id="inputField" name="url" value="{{ $url }}" required>
<div class="form-check">
  <input class="form-check-input" type="radio" name="file_extension" value="avi" id="file_extension2" checked>
  <label class="form-check-label" for="file_extension2">
    avi
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="file_extension" value="mov" id="file_extension1">
  <label class="form-check-label" for="file_extension1">
  mov
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="file_extension" value="mp4" id="file_extension1">
  <label class="form-check-label" for="file_extension1">
  mp4
  </label>
</div>
<div id="submit-btn-container">
    <button class="btn btn-primary" id="submit-btn" type="submit">Crawl</button>
</div>
</form>
