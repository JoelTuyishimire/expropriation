<div class="card shadow-none">
    <div class="card-body">
        <div class="row my-5">
            <div class="col-md-12">
                @forelse($histories as $history)
                    <div class="timeline timeline-5 my-4">
                        <div class="timeline-item">
                            <div class="timeline-label">
                                <small>{{$history->created_at->format('h:i s A')}}</small>
                            </div>
                            <div class="timeline-badge"><span class="bg-{{$history->status_color ?? 'color'}}"></span>
                            </div>
                            <div class="timeline-content bg-light p-4">
                                <p>
                                    {{ $history->comment}}

                                </p>
                                <span
                                    class="label label-light-dark-75  label-inline ml-2 rounded-pill">{{$history->created_at->format('d M Y')}}</span>
                                <span
                                    class="label label-{{$history->status_color ?? 'color'}}  label-inline ml-2 rounded-pill float-md-right">{{ $history->status }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-custom alert-notice alert-light-info rounded-0">
                        <div class="alert-icon">
                            <i class="flaticon-clock"></i>
                        </div>
                        <div class="alert-text">
                            No history found yet.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


