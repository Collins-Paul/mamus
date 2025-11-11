{{-- Modal when app has been installed --}}
<div class="modal fade" id="AppInstalled" tabindex="-1" aria-labelledby="AppInstalledLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="AppInstalledLabel">App Installation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
        <img src="{{ asset('assets/logo/'.$logo->icon) }}" alt="" style="width: 80px">
        <h5 class="mt-3">{{ config('app.name') }} App</h5>
        <h6 class="mt-3">Installed Successfully</h6>
        <p>Proceed to your Home Screen and open the {{ config('app.name') }} App.</p>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="redirectApp()" class="btn btn-success" data-bs-dismiss="modal">Open App</button>
        </div>
      </div>
    </div>
</div>
