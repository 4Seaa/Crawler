@if(!empty($results))
  @if ($file_extension)
  <button class="btn btn-success" id="download-all-btn"> Download all </button>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Result</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($results as $index => $result)
        <tr>
          <th scope="row">{{ $index + 1 }}</th>
          @if ($file_extension)
          <td><a href="{{ $result }}" target="_blank" class="download-link">{{ $result }}</a></td>
          @else
          <td>{{ $result }}</td>
          @endif
        </tr>
      @endforeach
    </tbody>
  </table>
@elseif($url)
<div class="alert alert-dark" role="alert">
  No results!
</div>
@endif
