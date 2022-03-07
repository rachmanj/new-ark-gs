<div class="col-12 col-sm-6 col-md-4">
  <div class="info-box mb-3">
    <span class="info-box-icon {{ $po_sent_vs_budget <= 100 ? 'bg-success' : 'bg-danger' }} elevation-1"><i class="fas {{ $po_sent_vs_budget <= 100 ? 'fa-thumbs-up' : 'fa-frown' }}"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">PO Sent vs Plant Budget</span>
      <h4><b>{{ number_format($po_sent_vs_budget, 2) }}</b> <small>%</small></h4>
    </div>
  </div>
</div>

<div class="col-12 col-sm-6 col-md-4">
  <div class="info-box mb-3">
    <span class="info-box-icon {{ $po_sent_vs_grpo >= 80 ? 'bg-success' : 'bg-danger' }} elevation-1"><i class="fas {{ $po_sent_vs_grpo >= 80 ? 'fa-thumbs-up' : 'fa-frown' }}"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">PO Sent vs GRPO</span>
      <h4><b>{{ number_format($po_sent_vs_grpo, 2) }}</b> <small>%</small></h4>
    </div>
  </div>
</div>

<div class="col-12 col-sm-6 col-md-4">
  <div class="info-box mb-3">
    <span class="info-box-icon {{ $npi <= 1 ? 'bg-success' : 'bg-danger' }} elevation-1"><i class="fas {{ $npi <= 1 ? 'fa-thumbs-up' : 'fa-frown' }}"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">N P I</span>
      <h4><b>{{ number_format($npi, 2) }}</b></h4>
    </div>
  </div>
</div>

