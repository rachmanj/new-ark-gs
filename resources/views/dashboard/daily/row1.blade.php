<div class="col-12 col-sm-6 col-md-4">
  <div class="info-box mb-3">
    <span class="info-box-icon {{ $reguler_daily['percentage'] * 100 <= 100 ? 'bg-success' : 'bg-danger' }} elevation-1"><i class="fas {{ $reguler_daily['percentage'] * 100 <= 100 ? 'fa-thumbs-up' : 'fa-frown' }}"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">PO Sent vs Plant Budget</span>
      <h4><b>{{ number_format($reguler_daily['percentage'] * 100, 2) }}</b> <small>%</small></h4>
    </div>
  </div>
</div>

<div class="col-12 col-sm-6 col-md-4">
  <div class="info-box mb-3">
    <span class="info-box-icon {{ $grpo_daily['total_percentage'] * 100 >= 80 ? 'bg-success' : 'bg-danger' }} elevation-1"><i class="fas {{ $grpo_daily['total_percentage'] * 100 >= 80 ? 'fa-thumbs-up' : 'fa-frown' }}"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">PO Sent vs GRPO</span>
      <h4><b>{{ number_format($grpo_daily['total_percentage'] * 100, 2) }}</b> <small>%</small></h4>
    </div>
  </div>
</div>

<div class="col-12 col-sm-6 col-md-4">
  <div class="info-box mb-3">
    <span class="info-box-icon {{ $npi_daily['total_percentage'] <= 1 ? 'bg-success' : 'bg-danger' }} elevation-1"><i class="fas {{ $npi_daily['total_percentage'] <= 1 ? 'fa-thumbs-up' : 'fa-frown' }}"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">N P I</span>
      <h4><b>{{ number_format($npi_daily['total_percentage'], 2) }}</b></h4>
    </div>
  </div>
</div>

